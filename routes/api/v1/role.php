<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\RoleController;
use App\Models\Role;

Route::middleware(['auth:sanctum', 'admin'])->as('roles.')->group(function () {

    Route::get('/roles', [RoleController::class, 'index'])->can('view', Role::class)
        ->name('index');

    Route::post('/roles/create', [RoleController::class, 'store'])->can('create', Role::class)
        ->name('create');

    Route::patch('/roles/{role}', [RoleController::class, 'update'])->can('update', Role::class)
        ->name('update');

    Route::delete('/roles/{role}/delete', [RoleController::class, 'delete'])->can('delete', Role::class)
        ->name('delete');

    Route::delete('/roles/{role}/destroy', [RoleController::class, 'destroy'])->can('delete', Role::class)
        ->name('destroy');

});
