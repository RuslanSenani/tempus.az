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

        $setting = Site_Settings::first();

        if (!$setting) {
            $this->error('Bazada heç bir tənzimləmə tapılmadı!');
            return;
        }


        $data = $setting->key_value;


        $oldToken = $data['instagram_access_token'] ?? null;

        if (!$oldToken) {
            $this->error('JSON-un içində "instagram_access_token" açarı tapılmadı!');
            return;
        }


        $response = Http::get("https://graph.instagram.com/refresh_access_token", [
            'grant_type' => 'ig_refresh_token',
            'access_token' => $oldToken,
        ]);

        if ($response->successful()) {
            $newToken = $response->json()['access_token'];


            $data['instagram_access_token'] = $newToken;


            $setting->update([
                'key_value' => $data
            ]);

            Log::info('Instagram tokeni uğurla yeniləndi.');
            $this->info('Uğurlu: Yeni token massiv daxilində yeniləndi.');
        } else {
            Log::error('Instagram token yenilənmə xətası: ' . $response->body());
            $this->error('Xəta baş verdi. Loglara baxın.');
        }
    }

}
