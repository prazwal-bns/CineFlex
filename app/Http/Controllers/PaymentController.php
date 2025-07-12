<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\Booking;
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
            session('total_price', 5000), // Use actual total price from session
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
                $totalPrice = session('total_price', 0);
                $userId = Auth::id();

                if (! $showtimeId || empty($selectedSeats) || ! $userId || ! is_numeric($userId)) {
                    throw new \Exception('Missing required booking information or user not authenticated');
                }

                $showtime = Showtime::findOrFail($showtimeId);

                $booking = Booking::create([
                    'user_id' => $userId,
                    'showtime_id' => $showtimeId,
                    'coupon_id' => null,
                    'status' => 'confirmed',
                    'total_price' => $totalPrice,
                    'discounted_price' => $totalPrice,
                ]);

                $booking->seats()->attach($selectedSeats);

                $payment = Payment::create([
                    'booking_id' => $booking->id,
                    'amount' => $totalPrice,
                    'payment_method' => 'esewa',
                    'transaction_id' => $transactionUuid,
                    'status' => PaymentStatus::COMPLETED,
                ]);

                DB::commit();

                session()->forget(['selected_seats', 'showtime_id', 'total_price', 'transaction_id']);

                Notification::make()
                    ->title('Booking Successful!')
                    ->body("Your booking has been confirmed. Booking ID: {$booking->id}")
                    ->success()
                    ->send();

                return redirect()->route('filament.admin.pages.dashboard');

            } catch (\Exception $e) {
                DB::rollBack();

                Notification::make()
                    ->title('Booking Failed')
                    ->body('There was an error processing your booking. Please try again.')
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
        session()->forget(['selected_seats', 'showtime_id', 'total_price', 'transaction_id']);

        Notification::make()
            ->title('Payment Failed')
            ->body('The payment process has failed. Please try again.')
            ->danger()
            ->send();

        return redirect()->route('filament.admin.pages.dashboard');
    }
}
