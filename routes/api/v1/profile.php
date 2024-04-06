<?php

declare(strict_types=1);


use App\Http\Controllers\Api\V1\UserNotificationController;

Route::middleware(['auth:sanctum'])->prefix('profile')->as('profile.')->group(function () {

    Route::get('notifications', [UserNotificationController::class, 'index'])
        ->name('notifications.index');

    Route::patch('notifications/{notification}', [UserNotificationController::class, 'makeRead'])
        ->name('notifications.makeRead');

    Route::delete('notifications/{notification}', [UserNotificationController::class, 'destroy'])
    ->name('notifications.destroy');

});
