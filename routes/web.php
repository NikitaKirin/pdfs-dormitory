<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\LogoutController;

Route::post('/login', LoginController::class)->middleware('guest')->name('login');
Route::get('/logout', LogoutController::class)->middleware('auth:sanctum')
    ->name('logout');
