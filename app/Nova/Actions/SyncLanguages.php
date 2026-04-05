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

    /**
     * Action-ın adı (Menyuda və düymədə görünən).
     */
    public function name()
    {
        return __('Sync Languages');
    }

    /**
     * Ləğv etmə düyməsinin mətni.
     * @param $text
     */
    public function cancelButtonText($text)
    {
        return __('Cancel');
    }

    /**
     * Təsdiq pəncərəsindəki açıqlama mətni.
     * @param $text
     */

    /**
     * Perform the action on the given models.
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        try {
            $service = new LanguageSyncService();
            $count = $service->syncFromJson();

            return Action::message(__(':count translations synced successfully.', ['count' => $count]));
        } catch (\Exception $e) {
            return Action::danger(__('Error occurred: :error', ['error' => $e->getMessage()]));
        }
    }

    public function fields(NovaRequest $request = null)
    {
        return [];
    }

}
