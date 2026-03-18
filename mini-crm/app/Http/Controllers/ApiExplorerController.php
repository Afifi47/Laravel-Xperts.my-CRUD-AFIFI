<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApiExplorerController extends Controller
{
    public function show(Request $request): View
    {
        $companies = Company::query()
            ->withCount('employees')
            ->latest()
            ->get(['id', 'name', 'email']);

        $selectedCompany = null;
        $payload = null;
        $rawUrl = route('api.companies.index');

        if ($companies->isNotEmpty()) {
            $selectedCompanyId = $request->filled('company')
                ? $request->integer('company')
                : $companies->first()->id;

            $selectedCompany = Company::query()->findOrFail($selectedCompanyId);
            $selectedCompany->load('employees')->loadCount('employees');
            $rawUrl = route('api.companies.show', $selectedCompany);

            $payload = json_encode(
                CompanyResource::make($selectedCompany)->resolve($request),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            );
        }

        return view('api-explorer.show', [
            'companies' => $companies,
            'selectedCompany' => $selectedCompany,
            'payload' => $payload,
            'rawUrl' => $rawUrl,
            'listUrl' => route('api.companies.index'),
        ]);
    }
}
