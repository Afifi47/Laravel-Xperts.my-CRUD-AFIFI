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
 * Security:
 * - Rate-limited to 60 requests/minute per IP (throttle:60,1)
 * - Read-only endpoints (GET only) — no mutation allowed
 *
 * Accessible at:
 *   GET /api/companies       → CompanyController@index (all companies paginated)
 *   GET /api/companies/{id}  → CompanyController@show  (single company + employees)
 */
Route::middleware('throttle:60,1')->prefix('companies')->group(function () {
    Route::get('/',    [CompanyController::class, 'index']); // GET /api/companies
    Route::get('/{company}', [CompanyController::class, 'show']);  // GET /api/companies/{id}
});
