<?php

namespace App\Nova;


use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Language extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Language>
     */
    public static $model = \App\Models\Language::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static $clickAction = 'select';


    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name','code'
    ];


    public static function label(): string
    {
        return 'Dillər';
    }

    public static $showColumnBorders = true;

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

            Text::make('Code', 'code')
                ->rules('required'),

            NovaTabTranslatable::make([
                Text::make('Name', 'name')
                    ->rules('required'),
            ])->setTitle('Name'),

            new Panel('Parametrlər', [
                Boolean::make('Status', 'is_active')
                    ->trueValue(1)
                    ->falseValue(0)
                    ->withMeta(['width' => 'w-1/4']),
                Boolean::make('Default', 'is_default')
                    ->trueValue(1)
                    ->falseValue(0)
                    ->withMeta(['width' => 'w-2/4'])
            ]),
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
}
