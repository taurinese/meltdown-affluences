<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('infos', [\App\Http\Controllers\ApiBookingController::class, 'getBooking']);

Route::post('booking', [ \App\Http\Controllers\ApiBookingController::class, 'addBooking']);

Route::post('booking/{token}', [\App\Http\Controllers\ApiBookingController::class, 'deleteBooking']);

