<?php

use App\Http\Controllers\Api\V1\AcademicGroupController;

Route::middleware(['auth:sanctum'])->as('academicGroups.')->prefix('academic-groups')->group(function () {

    Route::get('/', [AcademicGroupController::class, 'index'])->name('index');

});
