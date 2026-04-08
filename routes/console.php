<?php

use App\Models\Visit;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('instagram:refresh-token')->monthlyOn(1, '03:00');

Schedule::command('queue:work --stop-when-empty')->everyTenSeconds()->withoutOverlapping();

Schedule::call(function () {
    Visit::where('created_at', '<', now()->subDays(2))->delete();
})->daily();

