<?php

use App\Http\Controllers\Api\V1\GenderController;

Route::middleware(['auth:sanctum'])->as('genders.')->prefix('genders')->group(function () {

    Route::get('/', [GenderController::class, 'index'])->name('index');

});
