<?php

use App\Models\Visit;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('instagram:refresh-token')->monthlyOn(1, '03:00');

Schedule::command('queue:work --stop-when-empty')->everyMinute()->withoutOverlapping();

Schedule::call(function () {
    // 1. Bazaya gedən hər şeyi qulaq asırıq
    DB::listen(function ($query) {
        // Query-nin içində "visits" və "delete" sözü varsa log-a yaz
        if (str_contains($query->sql, 'delete') && str_contains($query->sql, 'visits')) {
            Log::info("Kankret SQL: " . $query->sql);
            Log::info("Kankret Dəyərlər (Bindings): ", $query->bindings);
        }
    });

    // 2. Əməliyyatı icra edirik
    Visit::where('created_at', '<', now()->subDays(1))->delete();

})->everyMinute();

//Schedule::call(function () {
//    Visit::where('created_at', '<', now()->subDays(2))->delete();
//})->daily();

Schedule::command('app:generate-sitemap')->dailyAt('02:00');
