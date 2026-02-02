<?php

namespace App\Nova;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mostafaznv\NovaCkEditor\CkEditor;

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
            ])->rules('required')
                ->displayUsingLabels(), // Index-də kiçik hərflə yox, 'Image' kimi göstərir

            // Şəkil Sahəsi
            Image::make('Image', 'image_url')
                ->disk('public')
                ->dependsOn(['type'], function (Image $field, NovaRequest $request, FormData $formData) {
                    if ($formData->type !== 'image') {
                        $field->hide();
                    }
                })
                ->store(function ($request, $model, $attribute, $requestAttribute) {
                    $file = $request->file($requestAttribute);
                    if (!$file) return null;

                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $path = "Media_Path/$filename";

                    // Version 3-də yeni Manager yaradılır
                    $manager = new ImageManager(new Driver());

                    // Şəkli oxuyuruq və ölçüləndiririk
                    $image = $manager->read($file)
                        ->pad(800, 600, 'ffffff');

                    // Şəkli formatlayıb Storage-a yazırıq
                    Storage::disk('public')->put($path, $image->toJpeg(80));

                    return [
                        $attribute => $path,
                    ];
                }),

            // Video URL Sahəsi
            Text::make('Video URL', 'video_url')
                ->help('YouTube, TikTok və ya Instagram linki əlavə edin')
                ->dependsOn(['type'], function (Text $field, NovaRequest $request, FormData $formData) {
                    if ($formData->type !== 'video') {
                        $field->hide();
                    }
                }),

            NovaTabTranslatable::make([
                Text::make('Title', 'title'),
                CkEditor::make('Description', 'description')
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
