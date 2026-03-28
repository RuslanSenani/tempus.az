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
     * Təsdiq pəncərəsi açılarkən görünən düymə mətni.
     * @param $text
     */
    public function confirmButtonText($text)
    {
        return __('Sync');
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
    public function confirmText($text)
    {
        return __('Are you sure you want to sync translations from File?');
    }

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


//    use InteractsWithQueue, Queueable;
//
//    public $name = 'Dilləri Sinxronla (JSON)';
//
//    /**
//     * Perform the action on the given models.
//     *
//     * @param \Laravel\Nova\Fields\ActionFields $fields
//     * @param \Illuminate\Support\Collection $models
//     * @return mixed
//     */
//    public function handle(ActionFields $fields, Collection $models)
//    {
//        try {
//            $service = new LanguageSyncService();
//            $count = $service->syncFromJson();
//
//            return Action::message("Uğurlu! {$count} ədəd tərcümə sinxronlaşdırıldı.");
//        } catch (\Exception $e) {
//            return Action::danger("Xəta baş verdi: " . $e->getMessage());
//        }
//    }
//
//    /**
//     * Get the fields available on the action.
//     *
//     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
//     * @return array
//     */
//    public function fields(NovaRequest $request=null)
//    {
//        return [];
//    }
}
