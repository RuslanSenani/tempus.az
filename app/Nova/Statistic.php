<?php

namespace App\Nova;

use App\Contracts\PartnersRepositoryInterface;
use App\Contracts\PreparationRepositoryInterface;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;


class Statistic extends Resource
{


    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Statistic>
     */
    public static $model = \App\Models\Statistic::class;

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
        $Preparation = app(PreparationRepositoryInterface::class);
        $Partner = app(PartnersRepositoryInterface::class);
        $preparationCount = $Preparation->getCount();
        $partnerCount = $Partner->getCount();


        return [
            ID::make()->sortable(),
            Text::make('Preparation Count', 'preparation_count')
                ->placeholder('Preparation Count: ' . $preparationCount)
                ->rules('required'),
            Text::make('Customer Count', 'customer_count')->rules('required'),
            Text::make('Partner Count', 'partner_count')
                ->placeholder('Partner Count: ' . $partnerCount)
                ->rules('required'),
            Boolean::make('Status', 'is_active')
                ->trueValue(1)
                ->falseValue(0)
                ->withMeta(['width' => 'w-1/4']),
            NovaTabTranslatable::make([
                Text::make('Title', 'title')->rules('required'),
                Text::make('Preparation', 'preparation')->rules('required'),
                Text::make('Customer', 'customer')->rules('required'),
                Text::make('Partner', 'partner')->rules('required'),
            ])
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
