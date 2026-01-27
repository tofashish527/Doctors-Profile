<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banner_settings', function (Blueprint $table) {
            $table->id();
            $table->string('doctor_name');
            $table->string('doctor_degree');
            $table->string('specialization');
            $table->text('bio');
            $table->string('doctor_image')->nullable();
            $table->string('intro_video')->nullable();
            $table->boolean('video_enabled')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banner_settings');
    }
};