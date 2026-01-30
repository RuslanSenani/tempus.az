<?php

namespace App\Nova;

use Illuminate\Support\Facades\Storage;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Media extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Media>
     */
    public static $model = \App\Models\Media::class;

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

            Select::make('Type', 'type')->options([
                'image' => 'Image',
                'video' => 'Video',
            ])->rules('required'),

            Text::make('Preview', 'url_path')
                ->onlyOnIndex()
                ->asHtml() // Text sahəsində bu metod var!
                ->displayUsing(function ($value, $resource) {
                    if (!$value) return null;

                    if ($resource->type === 'image') {
                        $url = Storage::disk('public')->url($value);
                        return '<img src="' . $url . '" style="width: 50px; height: 50px; border-radius: 4px; object-fit: cover;">';
                    }

                    return '<span style="color: #3b82f6;">📹 Video Link</span>';
                }),

            File::make('Image File', 'url_path')
                ->disk('public')
                ->path('Media_Path')
                ->onlyOnForms()
                ->dependsOn(['type'], function (File $field, NovaRequest $request, FormData $formData) {
                    if ($formData->type !== 'image') {
                        $field->hide();
                    }
                }),

            Text::make('Video URL', 'url_path')
                ->onlyOnForms()
                ->dependsOn(['type'], function (Text $field, NovaRequest $request, FormData $formData) {
                    if ($formData->type !== 'video') {
                        $field->hide();
                    }
                }),
//            File::make('File', 'url_path')
//                ->disk('public')
//                ->path('Media_Path'),

            NovaTabTranslatable::make([
                Text::make('Title', 'title'),
                Trix::make('Description', 'description')
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
