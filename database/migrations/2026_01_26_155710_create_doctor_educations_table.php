<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctor_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('banner_setting_id')->constrained()->onDelete('cascade');
            $table->string('degree_title');
            $table->string('institution');
            $table->string('start_year', 10);
            $table->string('end_year', 10);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_educations');
    }
};