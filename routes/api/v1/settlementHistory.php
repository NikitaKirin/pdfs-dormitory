<?php

declare(strict_types=1);


use App\Http\Controllers\Api\V1\SettlementHistoryController;
use App\Models\SettlementHistory;

Route::middleware('auth:sanctum')->prefix('settlement-history')->as('settlementHistory.')
    ->group(function () {

        Route::get('/records', [SettlementHistoryController::class, 'index'])
            ->can('view', SettlementHistory::class)->name('index');

        Route::get('/statuses', [SettlementHistoryController::class, 'indexSettlementStatuses'])
            ->can('view', SettlementHistory::class)->name('indexSettlementStatuses');

        Route::post('/records', [SettlementHistoryController::class, 'store'])
        ->can('create', SettlementHistory::class)->name('store');

        Route::patch('/records/{settlementHistory}', [SettlementHistoryController::class, 'update'])
            ->can('update', SettlementHistory::class)->name('update');

        Route::delete('/records/{settlementHistory}/delete', [SettlementHistoryController::class, 'delete'])
            ->can('delete', SettlementHistory::class)->name('delete');

        Route::delete('/records/{settlementHistory}/destroy', [SettlementHistoryController::class, 'destroy'])
            ->can('delete', SettlementHistory::class)->name('delete');

    });
