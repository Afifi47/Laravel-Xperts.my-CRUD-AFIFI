<?php
// app/Models/Company.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    /**
     * Mass-assignable fields.
     * Only these fields can be filled via create() / fill() / update().
     * This prevents mass-assignment vulnerabilities.
     */
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];

    /**
     * Relationship: A company has many employees.
     * Usage: $company->employees
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Accessor: get the full public URL for the logo.
     * Usage: $company->logo_url
     * Returns null if no logo is stored.
     */
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo
            ? Storage::disk('public')->url($this->logo)
            : null;
    }

    /**
     * Accessor: count employees directly on the model.
     * Usage: $company->employee_count
     */
    public function getEmployeeCountAttribute(): int
    {
        if (isset($this->attributes['employees_count'])) {
            return (int) $this->attributes['employees_count'];
        }

        return $this->relationLoaded('employees')
            ? $this->employees->count()
            : $this->employees()->count();
    }
}
