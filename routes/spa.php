<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class)->middleware('guest')->name('login');
Route::get('/logout', LogoutController::class)->middleware('auth:sanctum')
    ->name('logout');
