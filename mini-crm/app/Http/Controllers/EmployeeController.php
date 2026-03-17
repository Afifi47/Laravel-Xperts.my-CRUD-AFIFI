<?php
// app/Http/Controllers/EmployeeController.php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * EmployeeController
 *
 * Resource controller for Employee CRUD.
 * All routes protected by 'auth' middleware (set in routes/web.php).
 */
class EmployeeController extends Controller
{
    /**
     * Display paginated employee list.
     * Eager-loads company to prevent N+1 queries.
     */
    public function index(): View
    {
        $employees = Employee::with('company')->latest()->paginate(10);
        $totalEmployees = Employee::count();
        $totalCompanies = Company::count();

        return view('employees.index', compact('employees', 'totalEmployees', 'totalCompanies'));
    }

    /**
     * Show create form.
     * Passes list of companies for the dropdown.
     */
    public function create(): View
    {
        $companies = Company::orderBy('name')->pluck('name', 'id');

        return view('employees.create', compact('companies'));
    }

    /**
     * Store a new employee.
     */
    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        Employee::create($request->validated());

        return redirect()->route('employees.index')
                         ->with('success', 'Employee created successfully.');
    }

    /**
     * Show a single employee's details.
     */
    public function show(Employee $employee): View
    {
        $employee->load('company');

        return view('employees.show', compact('employee'));
    }

    /**
     * Show edit form.
     */
    public function edit(Employee $employee): View
    {
        $companies = Company::orderBy('name')->pluck('name', 'id');

        return view('employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update an employee.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $employee->update($request->validated());

        return redirect()->route('employees.index')
                         ->with('success', 'Employee updated successfully.');
    }

    /**
     * Delete an employee.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()->route('employees.index')
                         ->with('success', 'Employee deleted successfully.');
    }
}
