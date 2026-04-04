<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class UnblockIP extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            // Cache-dən bloklanmış IP-ni silirik
            cache()->forget('blocked_ip_' . $model->ip_address);
            // Həmçinin müraciət sayğacını sıfırlayırıq
            cache()->forget('visit_count_' . $model->ip_address);
            $model->update([
                'is_bot' => false
            ]);
        }

        return Action::message('Seçilmiş IP-lərin bloku uğurla açıldı!');
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
