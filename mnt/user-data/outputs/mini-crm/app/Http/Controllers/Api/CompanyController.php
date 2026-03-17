<?php
// app/Http/Controllers/Api/CompanyController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\JsonResponse;

/**
 * API CompanyController
 *
 * Handles API requests for companies.
 * Route: GET /api/companies/{company}
 *
 * Returns JSON using Laravel API Resources for consistent structure.
 * No auth required for this read-only endpoint (adjust if needed).
 */
class CompanyController extends Controller
{
    /**
     * Return a single company with its employees and employee_count.
     *
     * Example response:
     * {
     *   "data": {
     *     "id": 1,
     *     "name": "Acme Corp",
     *     "email": "contact@acme.com",
     *     "website": "https://acme.com",
     *     "logo": "http://localhost/storage/logos/file.png",
     *     "employee_count": 3,
     *     "employees": [...]
     *   }
     * }
     */
    public function show(Company $company): CompanyResource
    {
        // Eager-load employees to avoid N+1 query
        $company->load('employees');

        return new CompanyResource($company);
    }

    /**
     * Return all companies (paginated) — bonus endpoint.
     */
    public function index(): JsonResponse
    {
        $companies = Company::withCount('employees')->latest()->paginate(10);

        return response()->json([
            'data' => $companies->items(),
            'meta' => [
                'current_page' => $companies->currentPage(),
                'last_page'    => $companies->lastPage(),
                'per_page'     => $companies->perPage(),
                'total'        => $companies->total(),
            ],
        ]);
    }
}
