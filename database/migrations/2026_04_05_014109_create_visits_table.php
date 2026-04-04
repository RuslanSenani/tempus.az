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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->index()->unique(); // İndeks sürətli axtarış üçün vacibdir
            $table->string('browser')->nullable();
            $table->string('os')->nullable();
            $table->boolean('is_bot')->default(false); // Bot olub-olmadığı
            $table->text('user_agent')->nullable();
            $table->string('url')->nullable();
            $table->string('referer')->nullable(); // Haradan gəlib?
            $table->string('language', 10)->nullable(); // Hansı dildədir brauzer?
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
