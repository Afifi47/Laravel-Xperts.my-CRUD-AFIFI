<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Creates the initial admin user as specified in the assessment.
     * Run with: php artisan db:seed
     * Or together with migrations: php artisan migrate --seed
     */
    public function run(): void
    {
        // Create the admin user — updateOrCreate prevents duplicate seeding
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('password'), // bcrypt hashed
            ]
        );

        // Optional: seed sample companies & employees for demo purposes
        // Comment out if you want a clean start
        $this->call([
            CompanySeeder::class,
            EmployeeSeeder::class,
        ]);
    }
}
