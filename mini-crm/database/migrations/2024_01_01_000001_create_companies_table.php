<?php
// database/migrations/2024_01_01_000001_create_companies_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates the companies table with all required fields.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // Required
            $table->string('email')->nullable()->unique();   // Optional, must be unique
            $table->string('logo')->nullable();              // Path to stored logo file
            $table->string('website')->nullable();           // Optional URL
            $table->timestamps();                            // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
