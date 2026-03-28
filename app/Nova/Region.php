<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Http\Requests\NovaRequest;

class Region extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Region>
     */
    public static $model = \App\Models\Region::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static function group()
    {
        return __('Other');
    }
    public static function authorizedToCreate(Request $request): bool
    {
        return \App\Models\Region::count() === 0;
    }

    public function authorizedToDelete(Request $request): bool
    {
        return false;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            NovaTabTranslatable::make([

                KeyValue::make('Regionlar', 'names')
                    ->keyLabel('Sıra №')
                    ->valueLabel('Region Adı')
                    ->actionText('Yeni Region Əlavə Et'),
            ])->setTitle('Names')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
    public static function label()
    {
        return __('Regions');
    }


    public static function singularLabel()
    {
        return __('Region');
    }


    public static function createButtonLabel()
    {
        return __('New :resource Create', ['resource' => static::singularLabel()]);
    }

    public static function updateButtonLabel()
    {
        return __(':resource Update', ['resource' => static::singularLabel()]);
    }
}
