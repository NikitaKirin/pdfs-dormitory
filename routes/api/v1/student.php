<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\StudentController;
use App\Http\Controllers\Api\V1\StudentPaymentController;
use App\Models\Student;
use App\Models\StudentPayment;

Route::middleware(['auth:sanctum'])->as('students.')->prefix('students')->group(function () {

    Route::get('/', [StudentController::class, 'index'])->can('view', Student::class)
        ->name('index');

    Route::post('/', [StudentController::class, 'store'])->can('create', Student::class)
        ->name('store');

    Route::patch('{student}', [StudentController::class, 'update'])->can('update', Student::class)
        ->name('update');

    Route::delete('{student}/delete', [StudentController::class, 'delete'])
        ->can('delete', Student::class)->name('delete');

    Route::delete('{student}/destroy', [StudentController::class, 'destroy'])
        ->can('delete', Student::class)->name('destroy');

    Route::patch('{student}/settle', [StudentController::class, 'settle'])
        ->can('update', Student::class)->name('settle');

    Route::patch('{student}/evict', [StudentController::class, 'evict'])
        ->can('update', Student::class)->name('evict');


    Route::group(['prefix' => 'payments', 'as' => 'payments.'], function () {

        Route::post('import', [StudentPaymentController::class, 'import'])->
        can('import', StudentPayment::class)->name('import');

        Route::get('types', [StudentPaymentController::class, 'indexPaymentType'])
            ->can('view', StudentPayment::class)->name('types.index');

        Route::get('{student}', [StudentPaymentController::class, 'index'])
            ->can('view', StudentPayment::class)->name('index');

        Route::post('/', [StudentPaymentController::class, 'store'])
            ->can('create', StudentPayment::class)->name('store');

        Route::patch('{payment}', [StudentPaymentController::class, 'update'])
            ->can('update', StudentPayment::class)->name('update');

        Route::delete('{payment}/destroy', [StudentPaymentController::class, 'destroy'])
            ->can('delete', StudentPayment::class)->name('destroy');

    });
});
