<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banner_settings', function (Blueprint $table) {
            $table->text('biography')->nullable()->after('bio');
            $table->json('expertise')->nullable()->after('biography');
        });
    }

    public function down(): void
    {
        Schema::table('banner_settings', function (Blueprint $table) {
            $table->dropColumn(['biography', 'expertise']);
        });
    }
};