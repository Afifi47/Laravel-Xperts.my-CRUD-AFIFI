<?php
// app/Http/Requests/StoreCompanyRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Only authenticated users can submit this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Validation rules for creating a new company.
     *
     * Security notes:
     * - 'name' is required and capped at 255 chars (prevents oversized input)
     * - 'email' must be a valid email format and unique in the companies table
     * - 'logo' must be an actual image, min 100x100px, max 2MB
     * - 'website' validated as URL format
     */
    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['nullable', 'email', 'max:255', 'unique:companies,email'],
            'logo'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048', 'dimensions:min_width=100,min_height=100'],
            'website' => ['nullable', 'url', 'max:255'],
        ];
    }

    /**
     * Human-friendly error messages.
     */
    public function messages(): array
    {
        return [
            'name.required'        => 'Company name is required.',
            'email.unique'         => 'This email is already registered to another company.',
            'logo.image'           => 'The logo must be a valid image file.',
            'logo.dimensions'      => 'The logo must be at least 100×100 pixels.',
            'logo.max'             => 'The logo must not exceed 2MB.',
            'website.url'          => 'Please enter a valid URL (e.g. https://example.com).',
        ];
    }
}
