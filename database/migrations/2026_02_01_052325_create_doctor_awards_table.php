<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctor_awards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('banner_setting_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('organization');
            $table->string('year', 10);
            $table->string('icon')->default('fas fa-award'); // FontAwesome icon class
            $table->integer('rank')->default(0); // For ordering
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_awards');
    }
};