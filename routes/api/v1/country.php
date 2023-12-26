<?php

use App\Http\Controllers\Api\V1\CountryController;

Route::middleware(['auth:sanctum'])->as('countries.')->prefix('countries')->group(function () {

    Route::get('/', [CountryController::class, 'index'])->name('index');

});
