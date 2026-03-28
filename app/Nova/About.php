<?php

namespace App\Nova;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mostafaznv\NovaCkEditor\CkEditor;

class About extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\About>
     */
    public static $model = \App\Models\About::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

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
                ->prunable()
                ->store(function ($request, $model, $attribute, $requestAttribute) {
                    $file = $request->file($requestAttribute);
                    if (!$file) return null;
                    if ($model->image && Storage::disk('public')->exists($model->image)) {
                        Storage::disk('public')->delete($model->image);
                    }
                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $path = "about/$filename";

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

            NovaTabTranslatable::make([
                Text::make('Title', 'title')->rules('required'),
                CkEditor::make('Description', 'description')
                    ->rules('required')
                    ->withMeta([
                        'extraAttributes' => [
                            'style' => 'min-height:200px'
                        ]
                    ]),
                Text::make('Image AltText', 'image_alt_text'),
            ])->setTitle('Title, Description, Image Alt Text')

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
    public static function group()
    {
        return __('Other');
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
        return __('Abouts');
    }


    public static function singularLabel()
    {
        return __('About');
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
