<?php

use App\Http\Controllers\Api\V1\DormitoryController;
use App\Http\Controllers\Api\V1\DormRoomController;
use App\Models\Dormitory;

Route::middleware(['auth:sanctum'])->as('dormitories.')->group(function () {

    Route::get('dormitories', [DormitoryController::class, 'index'])->can('view', Dormitory::class)
        ->name('index');

    Route::post('dormitories/create', [DormitoryController::class, 'store'])
        ->can('create', Dormitory::class)->name('store');

    Route::patch('dormitories/{dormitory}', [DormitoryController::class, 'update'])
        ->can('update', Dormitory::class)->name('update');

    Route::delete('dormitories/{dormitory}/delete', [DormitoryController::class, 'delete'])
        ->can('delete', Dormitory::class)->name('delete');

    Route::delete('dormitories/{dormitory}/destroy', [DormitoryController::class, 'destroy'])
        ->can('delete', Dormitory::class)->name('destroy');

    Route::as('dormRooms.')->prefix('dormitories')->group(function () {

        Route::get('{dormitory}/dorm-rooms', [DormRoomController::class, 'index'])
            ->can('view', Dormitory::class)->name('index');

        Route::post('{dormitory}/dorm-rooms', [DormRoomController::class, 'store'])
            ->can('create', Dormitory::class)->name('store');

        Route::patch('dorm-rooms/{dormRoom}', [DormRoomController::class, 'update'])
            ->can('update', Dormitory::class)->name('update');

        Route::delete('dorm-rooms/{dormRoom}/delete', [DormRoomController::class, 'delete'])
            ->can('delete', Dormitory::class)->name('delete');

        Route::delete('dorm-rooms/{dormRoom}/destroy', [DormRoomController::class, 'destroy'])
            ->can('delete', Dormitory::class)->name('destroy');

    });

});
