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
            $table->json('activities')->after('vision')->nullable();
            $table->json('values')->after('activities')->nullable();
            $table->json('history')->after('values')->nullable();
            $table->json('advantages')->after('history')->nullable();
            $table->json('results_achievements')->after('advantages')->nullable();
            $table->json('team')->after('results_achievements')->nullable();
            $table->json('activity_zone')->after('team')->nullable();
            $table->string('logo1')->after('logo')->nullable();
            $table->string('logo2')->after('logo1')->nullable();
            $table->string('mission_vision_logo')->after('logo2')->nullable();
            $table->string('activities_logo')->after('mission_vision_logo')->nullable();
            $table->string('active_zone_logo')->after('activities_logo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['activities', 'values', 'history', 'advantages', 'results_achievements', 'team', 'activity_zone', 'logo1', 'logo2', 'mission_vision_logo', 'activities_logo']);

        });
    }
};
