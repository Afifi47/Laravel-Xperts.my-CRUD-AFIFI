<?php
// database/seeders/CompanySeeder.php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            ['name' => 'Acme Corporation',  'email' => 'contact@acme.com',    'website' => 'https://acme.com'],
            ['name' => 'Globex Corp',       'email' => 'info@globex.com',      'website' => 'https://globex.com'],
            ['name' => 'Initech',           'email' => 'hello@initech.com',    'website' => 'https://initech.com'],
        ];

        foreach ($companies as $company) {
            Company::firstOrCreate(['email' => $company['email']], $company);
        }
    }
}
