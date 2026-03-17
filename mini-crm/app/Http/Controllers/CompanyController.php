<?php
// app/Http/Controllers/CompanyController.php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * CompanyController
 *
 * Uses Laravel's resource controller pattern.
 * Register in routes/web.php with:
 *   Route::resource('companies', CompanyController::class);
 *
 * This auto-generates all 7 RESTful routes:
 *   GET    /companies           → index()
 *   GET    /companies/create    → create()
 *   POST   /companies           → store()
 *   GET    /companies/{id}      → show()
 *   GET    /companies/{id}/edit → edit()
 *   PUT    /companies/{id}      → update()
 *   DELETE /companies/{id}      → destroy()
 */
class CompanyController extends Controller
{
    /**
     * Display paginated list of companies.
     * 10 per page as specified in the assessment.
     */
    public function index(): View
    {
        $companies = Company::query()
            ->withCount('employees')
            ->latest()
            ->paginate(10);

        $totalCompanies = Company::count();
        $totalEmployees = Employee::count();

        return view('companies.index', compact('companies', 'totalCompanies', 'totalEmployees'));
    }

    /**
     * Show the form for creating a new company.
     */
    public function create(): View
    {
        return view('companies.create');
    }

    /**
     * Store a newly created company.
     *
     * Security:
     * - Validation is handled by StoreCompanyRequest (not here)
     * - Logo stored in storage/app/public/logos (not web root)
     * - Only accessible via storage symlink
     */
    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Handle logo upload securely
        if ($request->hasFile('logo')) {
            // store() saves to storage/app/public/logos/ and returns the path
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Company::create($data);

        return redirect()->route('companies.index')
                         ->with('success', 'Company created successfully.');
    }

    /**
     * Display a single company with its employees.
     */
    public function show(Company $company): View
    {
        // Eager-load employees to avoid N+1 query
        $company->load('employees')->loadCount('employees');

        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing a company.
     */
    public function edit(Company $company): View
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update an existing company.
     *
     * Logo handling:
     * - If a new logo is uploaded, old one is deleted from storage
     * - If no new logo, existing logo path is preserved
     */
    public function update(UpdateCompanyRequest $request, Company $company): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            // Delete old logo from storage if it exists
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            $data['logo'] = $request->file('logo')->store('logos', 'public');
        } else {
            // Remove 'logo' key so it isn't overwritten with null
            unset($data['logo']);
        }

        $company->update($data);

        return redirect()->route('companies.index')
                         ->with('success', 'Company updated successfully.');
    }

    /**
     * Delete a company and its logo.
     *
     * Note: Employee foreign keys are set to NULL on delete (see migration).
     */
    public function destroy(Company $company): RedirectResponse
    {
        // Clean up logo file from storage
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->delete();

        return redirect()->route('companies.index')
                         ->with('success', 'Company deleted successfully.');
    }
}
