<?php

namespace App\Observers;

use App\Models\Preparation;
use Illuminate\Support\Facades\Artisan;

class PreparationObserver
{
    /**
     * Handle the Preparation "created" event.
     */
    public function created(Preparation $preparation): void
    {
        $this->generateSitemap();
    }

    /**
     * Handle the Preparation "updated" event.
     */
    public function updated(Preparation $preparation): void
    {
        $this->generateSitemap();
    }

    /**
     * Handle the Preparation "deleted" event.
     */
    public function deleted(Preparation $preparation): void
    {
        $this->generateSitemap();
    }

    /**
     * Handle the Preparation "restored" event.
     */
    public function restored(Preparation $preparation): void
    {
        //
    }

    /**
     * Handle the Preparation "force deleted" event.
     */
    public function forceDeleted(Preparation $preparation): void
    {
        //
    }

    protected function generateSitemap(): void
    {
        // Bu bizim yaratdığımız artisan komandasını işə salır
        Artisan::call('app:generate-sitemap');
    }
}
