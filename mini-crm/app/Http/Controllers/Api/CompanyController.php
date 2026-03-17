<?php
// app/Http/Controllers/Api/CompanyController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * API CompanyController — Read-only JSON endpoints.
 *
 * Security:
 * - Read-only (GET only) — no create/update/delete
 * - Rate-limited via 'throttle' middleware in routes/api.php
 * - Uses Eloquent (no raw SQL) — prevents SQL injection
 * - Uses API Resources — controls exactly what data is exposed
 */
class CompanyController extends Controller
{
    /**
     * GET /api/companies
     * Returns paginated list of companies.
     */
    public function index(): AnonymousResourceCollection
    {
        $companies = Company::with('employees')->latest()->paginate(10);

        return CompanyResource::collection($companies);
    }

    /**
     * GET /api/companies/{company}
     * Returns a single company with employees and employee_count.
     */
    public function show(Company $company): CompanyResource
    {
        $company->load('employees');

        return new CompanyResource($company);
    }
}
