<?php
// app/Http/Requests/UpdateCompanyRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Rules for updating a company.
     *
     * Key difference from StoreCompanyRequest:
     * - Email uniqueness check ignores the CURRENT company's own email
     *   using Rule::unique()->ignore() — safer than string interpolation.
     * - Logo is optional on update (only replaced if a new file is uploaded).
     */
    public function rules(): array
    {
        $companyId = $this->route('company');

        return [
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['nullable', 'email', 'max:255', Rule::unique('companies', 'email')->ignore($companyId)],
            'logo'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048', 'dimensions:min_width=100,min_height=100'],
            'website' => ['nullable', 'url', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'   => 'Company name is required.',
            'email.unique'    => 'This email is already registered to another company.',
            'logo.image'      => 'The logo must be a valid image file.',
            'logo.dimensions' => 'The logo must be at least 100×100 pixels.',
            'logo.max'        => 'The logo must not exceed 2MB.',
            'website.url'     => 'Please enter a valid URL (e.g. https://example.com).',
        ];
    }
}
