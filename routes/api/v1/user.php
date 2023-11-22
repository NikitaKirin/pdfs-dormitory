<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\UserController;

Route::middleware('auth:sanctum')->as('users.')->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('index');

    Route::post('/users/create', [UserController::class, 'store'])->name('store');

    Route::patch('/users/{user}', [UserController::class, 'update'])->name('update');

    Route::delete('/users/{user}/delete', [UserController::class, 'delete'])->name('delete');

    Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])->name('destroy');

});
