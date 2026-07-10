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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['tuktuk', 'car', 'van', 'bus']);
            $table->string('plate_number')->unique();
            $table->unsignedInteger('capacity');
            $table->string('driver_name')->nullable();
            $table->string('driver_phone')->nullable();
            $table->enum('status', ['available', 'in_use', 'maintenance'])->default('available');
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
