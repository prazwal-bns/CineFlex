<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Showtime;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Xentixar\EsewaSdk\Esewa;

class PaymentController extends Controller
{
    public function payViaEsewa($showtimeId)
    {
        $showtime = Showtime::findOrFail($showtimeId);
        $transaction_id = 'TXN-' . uniqid();

        $booking = $showtime->bookings()->latest()->first();
        if ($booking) {
            $payment = $booking->payments()->latest()->first();

            if ($payment) {
                $payment->update([
                    'transaction_id' => $transaction_id
                ]);
            }
        }

        $esewa = new Esewa();
        $esewa->config(
            route('payment.success'), // Success URL
            route('payment.failure'), // Failure URL
            5000,
            $transaction_id
        );

        return $esewa->init();
    }

    public function esewaPaySuccess()
    {
        $esewa = new Esewa();
        $response = $esewa->decode();

        if ($response) {
            if (isset($response['transaction_uuid'])) {
                $transactionUuid = $response['transaction_uuid'];

                // Filament notification for success
                Notification::make()
                    ->title('Payment Successful')
                    ->body('The payment has been successfully completed.')
                    ->success()
                    ->send();

                return redirect()->route('filament.admin.pages.dashboard');
            }

            Notification::make()
                ->title('Payment Record Not Found')
                ->body('The transaction record could not be located.')
                ->danger()
                ->send();

            return redirect()->route('filament.admin.pages.dashboard');
        }

        Notification::make()
            ->title('Invalid Response')
            ->body('Received an invalid response from eSewa.')
            ->danger()
            ->send();

        return redirect()->route('filament.admin.pages.dashboard');
    }

    public function esewaPayFailure()
    {
        // Filament notification for failure
        Notification::make()
            ->title('Payment Failed')
            ->body('The payment process has failed. Please try again.')
            ->danger()
            ->send();

        return redirect()->route('filament.admin.pages.dashboard');
    }
}
