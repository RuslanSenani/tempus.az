<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('preparations', function (Blueprint $table) {
            $table->string('pdf')->nullable()->after('image');
            $table->string('official_document')->nullable()->after('pdf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('preparations', function (Blueprint $table) {
            $table->dropColumn(['pdf', 'official_document']);
        });
    }
};
