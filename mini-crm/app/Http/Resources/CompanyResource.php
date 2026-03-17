<?php
// app/Http/Resources/CompanyResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * CompanyResource — shapes the JSON output for a Company.
 *
 * Used by the API controller to return consistent, predictable JSON.
 * Includes 'employee_count' as an attribute as required by the assessment.
 */
class CompanyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'email'          => $this->email,
            'website'        => $this->website,

            // Full public URL to logo (null if no logo uploaded)
            'logo'           => $this->logo_url,

            // employee_count — required by assessment
            // Uses the model accessor defined in Company.php
            'employee_count' => $this->employee_count,

            // Nested employees array
            'employees'      => EmployeeResource::collection($this->whenLoaded('employees')),

            // Timestamps
            'created_at'     => $this->created_at?->toISOString(),
            'updated_at'     => $this->updated_at?->toISOString(),
        ];
    }
}
