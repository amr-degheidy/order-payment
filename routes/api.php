<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login',[AuthController::class,'login']);

Route::group(['middleware' => 'jwt','prefix' => 'orders','as' => 'orders.'], function () {
    Route::post('place-order',[OrderController::class,'placeOrder'])->name('place.order');
    Route::get('user-orders',[OrderController::class,'userOrders'])->name('user.orders');
});
