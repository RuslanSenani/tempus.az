<?php

namespace App\Console\Commands;

use App\Models\Site_Settings;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RefreshInstagramToken extends Command
{




    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:refresh-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instagram Long-Lived Access Tokeni yeniləyir';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 1. Bazadan köhnə tokeni götür
        $oldToken = Site_Settings::where('key_value', 'instagram_access_token')->first()->value;

        if (!$oldToken) {
            $this->error('Köhnə token tapılmadı!');
            return;
        }

        // 2. Instagram API-yə yeniləmə sorğusu at
        $response = Http::get("https://graph.instagram.com/refresh_access_token", [
            'grant_type' => 'ig_refresh_token',
            'access_token' => $oldToken,
        ]);

        if ($response->successful()) {
            $newToken = $response->json()['access_token'];

            // 3. Yeni tokeni bazaya yaz
             Site_Settings::where('key', 'instagram_token')->update(['value' => $newToken]);

            Log::info('Instagram tokeni uğurla yeniləndi.');
            $this->info('Uğurlu: Yeni token yadda saxlanıldı.');
        } else {
            Log::error('Instagram token yenilənmə xətası: ' . $response->body());
            $this->error('Xəta baş verdi. Loglara baxın.');
        }
    }
}
