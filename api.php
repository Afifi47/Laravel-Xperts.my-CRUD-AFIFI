<?php
// routes/api.php

use App\Http\Controllers\Api\CompanyController;
use Illuminate\Support\Facades\Route;

/**
 * API Routes
 *
 * These routes are automatically prefixed with /api
 * and use the 'api' middleware group (stateless, no session).
 *
 * Accessible at:
 *   GET /api/companies       → CompanyController@index (all companies paginated)
 *   GET /api/companies/{id}  → CompanyController@show  (single company + employees)
 *
 * Security note:
 * - For production, add Laravel Sanctum token auth:
 *   Route::middleware('auth:sanctum')->group(...)
 * - For this assessment, the endpoint is public (read-only).
 */
Route::prefix('companies')->group(function () {
    Route::get('/',    [CompanyController::class, 'index']); // GET /api/companies
    Route::get('/{company}', [CompanyController::class, 'show']);  // GET /api/companies/{id}
});
