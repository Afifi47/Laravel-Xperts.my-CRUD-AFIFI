<?php
// database/migrations/2024_01_01_000002_create_employees_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates the employees table with FK to companies.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');                        // Required
            $table->string('last_name');                         // Required
            $table->foreignId('company_id')                      // FK → companies.id
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();                               // Set null if company deleted
            $table->string('email')->nullable();                 // Optional
            $table->string('phone', 50)->nullable();             // Optional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
