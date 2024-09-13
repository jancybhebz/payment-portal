<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citizens', function (Blueprint $table) {
            $table->id('client_id');  // Client ID (Primary Key)
            $table->string('last_name');  // Last Name
            $table->string('first_name');  // First Name
            $table->string('middle_name')->nullable();  // Middle Name (Nullable)
            $table->string('street_address');  // Street Address
            $table->string('barangay');  // Barangay
            $table->string('town');  // Town
            $table->string('province');  // Province
            $table->string('mobile_number');  // Mobile Number
            $table->string('email')->unique();  // Email (Unique)
            $table->timestamps();  // Created_at and Updated_at
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citizens');
    }
};
