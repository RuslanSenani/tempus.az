<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class UnblockIP extends Action
{
    use InteractsWithQueue, Queueable;


    public function name()
    {
        return __('Unblock IP');
    }

    public function confirmButtonText($text)
    {
        return __('Unblock IP');
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
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        try {
            foreach ($models as $model) {
                // 1. Cache-dən bloklanmış IP-ni silirik
                cache()->forget('blocked_ip_' . $model->ip_address);

                // 2. Müraciət sayğacını sıfırlayırıq
                cache()->forget('visit_count_' . $model->ip_address);

                // 3. Verilənlər bazasında qeydi yeniləyirik
                $model->update([
                    'is_bot' => false
                ]);
            }

            $count = count($models);

            // Hər şey uğurludursa, yaşıl bildiriş
            return Action::message(__('Success_Message', ['count' => $count]));

        } catch (\Exception $e) {

            Log::error("IP Blok açma xətası: " . $e->getMessage());

            // Adminə qırmızı bildiriş (danger) göndəririk
            return Action::danger(__('Error_Message'));
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields($request = null)
    {
        return [];
    }
}
