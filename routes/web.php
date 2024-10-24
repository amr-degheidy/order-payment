<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('payment/payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('payment/payment-cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
