<?php

namespace App\Observers;

use App\Models\Language;

class LanguageObserver
{
    /**
     * Handle the Language "created" event.
     */
    public function created(Language $language): void
    {
        cache()->forget('locales');
    }

    /**
     * Handle the Language "updated" event.
     */
    public function updated(Language $language): void
    {
        cache()->forget('locales');
    }

    /**
     * Handle the Language "deleted" event.
     */
    public function deleted(Language $language): void
    {
        cache()->forget('locales');
    }

    /**
     * Handle the Language "restored" event.
     */
    public function restored(Language $language): void
    {
        cache()->forget('locales');
    }

    /**
     * Handle the Language "force deleted" event.
     */
    public function forceDeleted(Language $language): void
    {
        //
    }
}
