<?php

namespace App\Nova\Actions;

use App\Services\LanguageSyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class SyncLanguages extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Dilləri Sinxronla (JSON)';

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        try {
            $service = new LanguageSyncService();
            $count = $service->syncFromJson();

            return Action::message("Uğurlu! {$count} ədəd tərcümə sinxronlaşdırıldı.");
        } catch (\Exception $e) {
            return Action::danger("Xəta baş verdi: " . $e->getMessage());
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request=null)
    {
        return [];
    }
}
