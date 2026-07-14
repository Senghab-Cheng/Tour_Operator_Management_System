<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_schedule_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_schedule_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tour_guide_id')->constrained()->cascadeOnDelete();
            $table->foreignId('posted_by')->constrained('users')->cascadeOnDelete();
            $table->text('comment');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_schedule_comments');
    }
};