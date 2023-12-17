<?php

use App\Http\Controllers\Api\V1\StudentController;

Route::middleware(['auth:sanctum'])->as('students.')->group(function (){

    Route::get('students', [StudentController::class, 'index'])->can('view')->name('index');

});
