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
        Schema::table('settings', function (Blueprint $table) {
            $table->json('activities')->after('vision');
            $table->json('values')->after('activities');
            $table->json('history')->after('values');
            $table->json('advantages')->after('history');
            $table->json('results_achievements')->after('advantages');
            $table->json('team')->after('results_achievements');
            $table->json('activity_zone')->after('team');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['activities', 'values', 'history', 'advantages', 'results_achievements', 'team', 'activity_zone']);

        });
    }
};
