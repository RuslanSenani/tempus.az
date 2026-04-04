<?php

namespace App\Jobs;

use App\Models\Visit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
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
            Visit::updateOrCreate(
                ['ip_address' => $this->data['ip_address']],
                $this->data
            );
        } catch (\Exception $e) {
            Log::error("BAZAYA YAZILARKEN XƏTA: " . $e->getMessage());
        }
    }

}
