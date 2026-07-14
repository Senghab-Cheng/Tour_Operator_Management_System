<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tour_guides', function (Blueprint $table) {
            $table->string('skills')->nullable()->after('bio');
        });
    }

    public function down(): void
    {
        Schema::table('tour_guides', function (Blueprint $table) {
            $table->dropColumn('skills');
        });
    }
};