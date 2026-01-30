<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class MedicalInfo extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\MedicalInfo>
     */
    public static $model = \App\Models\MedicalInfo::class;

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
            Image::make('Image', 'image')
                ->disk('public')
                ->path('medicalInfo')
                ->preview(function ($value, $disk) {
                    return $value ? Storage::disk($disk)->url($value) : null;
                })
                ->thumbnail(function ($value, $disk) {
                    return $value ? Storage::disk($disk)->url($value) : null;
                })
                ->rules('nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048')
                ->prunable(),

            NovaTabTranslatable::make([
                Text::make('Title', 'title')->rules('required', 'max:100'),
                Text::make('Image Alt Text', 'image_alt_text')->rules('required', 'max:100'),
                Trix::make('Content', 'content')->rules('required')
                    ->withMeta([
                        'extraAttributes' => [
                            'style' => 'min-height:200px'
                        ]
                    ]),
                Slug::make('Slug', 'slug')
                    ->from('title')
                    ->separator('-')
                    ->readonly(),
            ])->setTitle('Title, Content, Slug'),
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
