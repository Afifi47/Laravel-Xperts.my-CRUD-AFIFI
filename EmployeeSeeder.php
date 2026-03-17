<?php
// database/seeders/EmployeeSeeder.php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $acme   = Company::where('email', 'contact@acme.com')->first();
        $globex = Company::where('email', 'info@globex.com')->first();

        if ($acme) {
            Employee::firstOrCreate(
                ['email' => 'john@acme.com'],
                ['first_name' => 'John', 'last_name' => 'Doe',   'company_id' => $acme->id,   'phone' => '0123456789']
            );
            Employee::firstOrCreate(
                ['email' => 'jane@acme.com'],
                ['first_name' => 'Jane', 'last_name' => 'Smith', 'company_id' => $acme->id,   'phone' => '0198765432']
            );
        }

        if ($globex) {
            Employee::firstOrCreate(
                ['email' => 'bob@globex.com'],
                ['first_name' => 'Bob',  'last_name' => 'Burns', 'company_id' => $globex->id, 'phone' => '0111234567']
            );
        }
    }
}
