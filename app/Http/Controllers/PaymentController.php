<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\Booking;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\Showtime;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Xentixar\EsewaSdk\Esewa;

class PaymentController extends Controller
{
    public function payViaEsewa($showtimeId)
    {
        $showtime = Showtime::findOrFail($showtimeId);
        $transaction_id = 'TXN-'.uniqid();

        // Store transaction ID in session for later use
        session(['transaction_id' => $transaction_id]);

        $esewa = new Esewa;
        $esewa->config(
            route('payment.success'), // Success URL
            route('payment.failure'), // Failure URL
            session('total_price', 5000), // Use actual total price from session (after discount)
            $transaction_id
        );

        return $esewa->init();
    }

    public function esewaPaySuccess()
    {
        $esewa = new Esewa;
        $response = $esewa->decode();

        if ($response && isset($response['transaction_uuid'])) {
            $transactionUuid = $response['transaction_uuid'];

            // Verify this is a valid transaction
            if ($transactionUuid !== session('transaction_id')) {
                Notification::make()
                    ->title('Invalid Transaction')
                    ->body('Transaction verification failed.')
                    ->danger()
                    ->send();

                return redirect()->route('filament.admin.pages.dashboard');
            }

            try {
                DB::beginTransaction();

                // Get session data
                $showtimeId = session('showtime_id');
                $selectedSeats = session('selected_seats', []);
                $finalPrice = session('total_price', 0); // Final price after discount
                $originalPrice = session('original_price', 0);
                $discountAmount = session('discount_amount', 0);
                $couponId = session('coupon_id');
                $userId = Auth::id();

                if (! $showtimeId || empty($selectedSeats) || ! $userId || ! is_numeric($userId)) {
                    throw new \Exception('Missing required booking information or user not authenticated');
                }

                $showtime = Showtime::findOrFail($showtimeId);

                // Create booking with coupon information
                $booking = Booking::create([
                    'user_id' => $userId,
                    'showtime_id' => $showtimeId,
                    'coupon_id' => $couponId,
                    'status' => 'confirmed',
                    'total_price' => $originalPrice, // Original price before discount
                    'discounted_price' => $finalPrice, // Final price after discount
                ]);

                // Attach selected seats to the booking
                $booking->seats()->attach($selectedSeats);

                // Create payment record
                $payment = Payment::create([
                    'booking_id' => $booking->id,
                    'amount' => $finalPrice, // Amount actually paid (after discount)
                    'payment_method' => 'esewa',
                    'transaction_id' => $transactionUuid,
                    'status' => PaymentStatus::COMPLETED,
                ]);

                // Update coupon usage count if coupon was used
                if ($couponId) {
                    $coupon = Coupon::find($couponId);
                    if ($coupon) {
                        $coupon->increment('times_used');
                    }
                }

                DB::commit();

                // Clear session data
                session()->forget([
                    'selected_seats',
                    'showtime_id',
                    'total_price',
                    'original_price',
                    'discount_amount',
                    'coupon_id',
                    'coupon_code',
                    'transaction_id'
                ]);

                // Success notification with booking details and display showtime details
                $successMessage = "Congratulations! Your booking has been confirmed. Booking ID: {$booking->id}";
                if ($discountAmount > 0) {
                    $successMessage .= " | You saved NPR " . number_format($discountAmount, 2) . " with your coupon!";
                }
                $successMessage .= " | Showtime: {$showtime->movie->title} at {$showtime->start_time}";

                Notification::make()
                    ->title('Booking Successful!')
                    ->body($successMessage)
                    ->success()
                    ->send();

                return redirect()->route('filament.admin.pages.dashboard');

            } catch (\Exception $e) {
                DB::rollBack();

                Notification::make()
                    ->title('Booking Failed')
                    ->body('There was an error processing your booking: ' . $e->getMessage())
                    ->danger()
                    ->send();

                return redirect()->route('filament.admin.pages.dashboard');
            }
        }

        Notification::make()
            ->title('Payment Verification Failed')
            ->body('Unable to verify payment with eSewa. Please contact support.')
            ->danger()
            ->send();

        return redirect()->route('filament.admin.pages.dashboard');
    }

    public function esewaPayFailure()
    {
        session()->forget([
            'selected_seats',
            'showtime_id',
            'total_price',
            'original_price',
            'discount_amount',
            'coupon_id',
            'coupon_code',
            'transaction_id'
        ]);

        Notification::make()
            ->title('Payment Failed')
            ->body('The payment process has failed. Please try again.')
            ->danger()
            ->send();

        return redirect()->route('filament.admin.pages.dashboard');
    }
}
