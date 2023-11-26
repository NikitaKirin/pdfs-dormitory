<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\UserController;
use App\Models\User;

Route::middleware(['auth:sanctum', 'admin'])->as('users.')->group(function () {

    Route::get('/users', [UserController::class, 'index'])->can('view', User::class)
        ->name('index');

    Route::post('/users/create', [UserController::class, 'store'])->can('create', User::class)
        ->name('store');

    Route::patch('/users/{user}', [UserController::class, 'update'])->can('update', User::class)
        ->name('update');

    Route::delete('/users/{user}/delete', [UserController::class, 'delete'])->can('delete', User::class)
        ->name('delete');

    Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])->can('delete', User::class)
        ->name('destroy');

});
