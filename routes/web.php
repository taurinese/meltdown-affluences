<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index');

Route::get('/reservation', [\App\Http\Controllers\BookingFormController::class, 'show'])->name('booking.form');

Route::post('/reservation', [ \App\Http\Controllers\BookingFormController::class, 'add'])->name('booking.send');

Route::get('/reservation/annulation/{token}', [\App\Http\Controllers\BookingCancelController::class, 'show'])->name('booking.cancel');

Route::post('/reservation/annulation/{token}', [\App\Http\Controllers\BookingCancelController::class, 'delete'])->name('booking.delete');


