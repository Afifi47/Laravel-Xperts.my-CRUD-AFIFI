<?php
// app/Http/Requests/UpdateEmployeeRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'company_id' => ['nullable', 'exists:companies,id'],
            'email'      => ['nullable', 'email', 'max:255'],
            'phone'      => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required'  => 'Last name is required.',
            'company_id.exists'   => 'The selected company does not exist.',
            'email.email'         => 'Please enter a valid email address.',
        ];
    }
}
