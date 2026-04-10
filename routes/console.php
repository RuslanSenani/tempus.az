<?php

use App\Models\Visit;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('instagram:refresh-token')->monthlyOn(1, '03:00');

Schedule::command('queue:work --stop-when-empty')->everyMinute()->withoutOverlapping();

Schedule::call(function () {
    $query = Visit::where('created_at', '<', now()->subDays(2));

    // Kankret olaraq sorğunu və dəyərləri götürürük
    $sql = $query->toSql();
    $bindings = $query->getBindings();

    // Log-a birbaşa yazdırırıq
    Log::info("SQL: " . $sql);
    Log::info("Bindings: ", $bindings);

    // Sonra da icra edirik
    $query->delete();
})->everyMinute();

//Schedule::call(function () {
//    Visit::where('created_at', '<', now()->subDays(2))->delete();
//})->daily();

Schedule::command('app:generate-sitemap')->dailyAt('02:00');
