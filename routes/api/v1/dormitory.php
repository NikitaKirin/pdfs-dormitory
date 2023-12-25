<?php

use App\Http\Controllers\Api\V1\DormitoryController;
use App\Models\Dormitory;

Route::middleware(['auth:sanctum'])->as('dormitories.')->group(function () {

    Route::get('dormitory', [DormitoryController::class, 'index'])->can('view', Dormitory::class)
        ->name('index');

    Route::post('dormitories/create', [DormitoryController::class, 'store'])
        ->can('create', Dormitory::class)->name('store');

    Route::patch('dormitories/{dormitory}', [DormitoryController::class, 'update'])
        ->can('update', Dormitory::class)->name('update');

    Route::delete('dormitories/{dormitory}/delete', [DormitoryController::class, 'delete'])
        ->can('delete', Dormitory::class)->name('delete');

    Route::delete('dormitories/{dormitory}/destroy', [DormitoryController::class, 'destroy'])
        ->can('delete', Dormitory::class)->name('destroy');

});
