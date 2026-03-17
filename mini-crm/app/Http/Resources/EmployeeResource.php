<?php
// app/Http/Resources/EmployeeResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * EmployeeResource — shapes the JSON output for an Employee.
 */
class EmployeeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'full_name'  => $this->full_name, // Uses model accessor
            'email'      => $this->email,
            'phone'      => $this->phone,
            'company_id' => $this->company_id,
        ];
    }
}
