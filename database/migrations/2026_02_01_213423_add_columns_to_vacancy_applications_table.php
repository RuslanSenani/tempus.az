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
        Schema::table('vacancy_applications', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('surname')->after('name');
            $table->string('email')->after('surname');
            $table->string('phone')->after('email');
            $table->string('vacancy_name')->after('phone');
            $table->string('available_days')->nullable()->after('vacancy_name');
            $table->string('work_experience')->nullable()->after('available_days');
            $table->text('message')->nullable()->after('work_experience');
            $table->boolean('is_read')->default(false)->after('message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vacancy_applications', function (Blueprint $table) {
            $table->dropColumn(['name', 'surname', 'email', 'phone', 'vacancy_name', 'available_days', 'work_experience', 'message']);
        });
    }
};
