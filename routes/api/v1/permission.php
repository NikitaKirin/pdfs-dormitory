<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\PermissionController;

Route::middleware(['auth:sanctum'])->as('permissions.')->group(function () {

    Route::get('permissions', [PermissionController::class, 'index'])->name('index');

});
