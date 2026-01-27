<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctor_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('banner_setting_id')->constrained()->onDelete('cascade');
            $table->string('position');
            $table->string('organization');
            $table->string('start_year', 10);
            $table->string('end_year', 10)->nullable(); // null means "Present"
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_experiences');
    }
};