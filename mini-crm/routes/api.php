<?php

use App\Http\Controllers\Api\CompanyController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,1')
    ->prefix('companies')
    ->name('api.companies.')
    ->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('index');
        Route::get('/{company}', [CompanyController::class, 'show'])->name('show');
    });
