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


Auth::routes();

Route::get('/',       [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/plans',      [App\Http\Controllers\Plans\PlansController::class, 'index'])->name('plans');
Route::get('/subscribe',  [App\Http\Controllers\Subscribe\SubscribeController::class, 'index'])->name('subscribe');
Route::get('/checkout',   [App\Http\Controllers\Checkout\CheckoutController::class, 'index'])->name('checkout');


