<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/checkout/pay', [CheckoutController::class, 'pay']);
});
