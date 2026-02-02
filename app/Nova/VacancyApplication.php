<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mostafaznv\NovaCkEditor\CkEditor;

class VacancyApplication extends Resource
{

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\VacancyApplication>
     */
    public static $model = \App\Models\VacancyApplication::class;

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
        'id', 'name', 'surname', 'phone', 'email'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        if ($request->isMethod('GET') && $request->route('resourceId')) {
            $this->resource->update([
                'is_read' => true
            ]);
        }

        return [
            ID::make()->sortable(),
            Text::make('Name', 'name')->sortable(),
            Text::make('Surname', 'surname')->sortable(),
            Text::make('Email', 'email')->sortable(),
            Text::make('Phone', 'phone')->sortable(),
            Text::make('Vacancy Name', 'vacancy_name'),
            Badge::make('Müsahibə Günü', 'available_days')->map([
                'B.E' => 'info',
                'Ç.A' => 'warning',
                'Ç'   => 'warning',
                'C.A' => 'success',
                'C'   => 'info',
            ]),
            CkEditor::make('Message', 'message'),
            CkEditor::make('Work Experience', 'work_experience'),
            Boolean::make('Is Read'),

            DateTime::make('Created At')->exceptOnForms(),
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
    public static function group(): string
    {
        return trans('Message');
    }
}
