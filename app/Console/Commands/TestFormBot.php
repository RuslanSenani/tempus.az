<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestFormBot extends Command
{// Komandanın adı (Terminalda işlətmək üçün)
    protected $signature = 'test:bot {count=10}';

    protected $description = 'Formu test etmək üçün bot sorğuları göndərir';

    public function handle()
    {
        $count = $this->argument('count');
        $url = url('https://123.az/partners'); // Sənin contact route-un (route name deyil, birbaşa URL)

        $this->info("$count ədəd sorğu göndərilir: $url");

        for ($i = 1; $i <= $count; $i++) {
            $response = Http::asForm()->get($url, [
                'name' => 'Bot Test ' . $i,
                'email' => "bot$i@test.com",
                'phone' => '0501234567',
                'message' => 'Bu bir avtomatlaşdırılmış test mesajıdır #' . $i,
                // Əgər @csrf istifadə edirsənsə, lokalda çox vaxt Http client bunu avtomatik keçir,
                // amma problem olsa middleware-dən çıxarmalı olacaqsan.
            ]);

            if ($response->successful()) {
                $this->info("Sorğu $i: Uğurlu (200)");
            } else {
                $this->error("Sorğu $i: Uğursuz (" . $response->status() . ")");
            }

            // Çox sürətli olub serveri bloklamasın deyə 0.5 saniyə gözləyə bilərsən
            usleep(500000);
        }

        $this->info("Test tamamlandı.");
    }
}
