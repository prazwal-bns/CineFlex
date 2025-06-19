<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth','verified'])->group(function(){
    Route::get('/movie-booking/payment/{showtimeId}', [PaymentController::class, 'payViaEsewa'])->name('payViaEsewa');

    Route::match(['get', 'post'],'/payment/success', [PaymentController::class, 'esewaPaySuccess'])->name('payment.success');
    Route::get('/payment/failure', [PaymentController::class, 'esewaPayFailure'])->name('payment.failure');
});
