<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestFormBot extends Command
{
    // Komandanın adı (Terminalda işlətmək üçün)
    protected $signature = 'test:bot {count=10}';

    protected $description = 'Formu test etmək üçün bot sorğuları göndərir';

    public function handle()
    {
        $count = $this->argument('count');
        $url = url('/contact');

        $this->info("$count ədəd sorğu göndərilir: $url");

        for ($i = 1; $i <= $count; $i++) {
            $response = Http::asForm()->get($url, [
                'name' => 'Bot Test ' . $i,
                'email' => "bot$i@test.com",
                'phone' => '0501234567',
                'message' => 'Bu bir avtomatlaşdırılmış test mesajıdır #' . $i,
            ]);

            if ($response->successful()) {
                $this->info("Sorğu $i: Uğurlu (200)");
            } else {
                $this->error("Sorğu $i: Uğursuz (" . $response->status() . ")");
            }

            usleep(500000);
        }

        $this->info("Test tamamlandı.");
    }
}
