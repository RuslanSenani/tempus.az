<?php

namespace App\Jobs;

use App\Models\Visit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LogVisitJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            $data = $this->data;

            Visit::updateOrCreate(
                ['ip_address' => $data['ip_address']],
                [
                    'url' => $data['url'],
                    'browser' => $data['browser'],
                    'os' => $data['os'],
                    'is_bot' => $data['is_bot'],
                    'user_agent' => $data['user_agent'],
                    'referer' => $data['referer'],
                    'language' => $data['language'] ?? 'en',
                    'reason' => $data['reason'] ?? null,
                ]
            )->increment('request_count');

        } catch (\Exception $e) {
            if (!str_contains($e->getMessage(), 'Duplicate entry')) {
                Log::error("BAZAYA YAZILARKEN XƏTA: " . $e->getMessage());
            }
        }
    }

//    public function handle()
//    {
//
//        try {
//            $visit = Visit::firstOrCreate(
//                ['ip_address' => $this->data['ip_address']],
//                $this->data,
//
//            );
//
//            // 2. Məlumatları yenilə və sayğacı artır
//            $visit->update([
//                'url' => $this->data['url'],
//                'reason' => $this->data['reason'] ?? $visit->reason,
//                'updated_at' => now(),
//            ]);
//
//            $visit->increment('request_count');
//        } catch (\Exception $e) {
//            Log::error("BAZAYA YAZILARKEN XƏTA: " . $e->getMessage());
//        }
//    }

}
