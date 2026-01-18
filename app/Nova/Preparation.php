<?php

namespace App\Nova;

use App\Repository\PreparationCategoryRepository;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Preparation extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Preparation>
     */
    public static $model = \App\Models\Preparation::class;

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
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $preparationCategoryRepository = app(PreparationCategoryRepository::class);

        return [
            ID::make()->sortable(),
            Select::make('Category', 'category_id')
                ->options($preparationCategoryRepository->getPreparationCategory())
                ->dependsOn(['lang_id'], function (Select $field, NovaRequest $request, $formData) use ($preparationCategoryRepository) {
                    if ($formData->lang_id) {
                        $field->options($preparationCategoryRepository->getPreparationCategoriesByLang($formData->lang_id));
                    }
                })
                ->displayUsingLabels(),

            Text::make('Name', 'name')
                ->rules('required', 'max:255'),
            Text::make('Title', 'title')
                ->rules('required', 'max:255'),
            Trix::make('Description', 'description'),
            Slug::make('Slug', 'slug')
                ->from('Name')
                ->separator('-')
                ->rules('required', 'max:255')
                ->creationRules('unique:preparations,Slug')
                ->updateRules('unique:preparations,Slug,{{resourceId}}'),
            Image::make('Image', 'image')
                ->disk('public')
                ->path('preparation')
                ->preview(function ($value, $disk) {
                    return $value ? Storage::disk($disk)->url($value) : null;
                })
                ->thumbnail(function ($value, $disk) {
                    return $value ? Storage::disk($disk)->url($value) : null;
                })
                ->rules('nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048')
                ->prunable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
