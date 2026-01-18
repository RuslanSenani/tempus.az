<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Contact extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Contact>
     */
    public static $model = \App\Models\Contact::class;

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

            Text::make('Phone', 'phone')->withMeta([
                'extraAttributes' => [
                    'onkeypress' => 'return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 43 || event.charCode == 40 || event.charCode == 41 || event.charCode == 45'
                ]
            ])
                ->rules('required', 'max:20'),
            Text::make('Email', 'email')
                ->rules('required', 'email', 'max:255'),
            NovaTabTranslatable::make([
                Text::make('Address', 'address'),
                Text::make('Xəritə Linki (URL)', 'map_link')
                    ->rules('required', 'url')
                    ->help('Google Maps-dən "Paylaş" düyməsinə sıxaraq linki bura yapışdırın.')
                    ->displayUsing(function ($value) {
                        return $value ? "<a href='{$value}' target='_blank' class='link-default'>Xəritədə Bax</a>" : '-';
                    })->asHtml(),
            ])->setTitle('Address, Xəritə Linki (URL)'),

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
