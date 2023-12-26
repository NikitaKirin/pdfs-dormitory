<?php

use App\Http\Controllers\Api\V1\StudentController;
use App\Models\Student;

Route::middleware(['auth:sanctum'])->as('students.')->prefix('students')->group(function () {

    Route::get('/', [StudentController::class, 'index'])->can('view')->name('index');

    Route::post('/', [StudentController::class, 'store'])->can('create', Student::class)
        ->name('index');

    Route::patch('{student}', [StudentController::class, 'update'])->can('update', Student::class)
        ->name('update');

    Route::delete('{student}/delete', [StudentController::class, 'delete'])
        ->can('delete', Student::class)->name('delete');

    Route::delete('{student}/destroy', [StudentController::class, 'destroy'])
        ->can('delete', Student::class)->name('delete');
});
