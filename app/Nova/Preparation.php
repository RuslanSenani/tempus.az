<?php

namespace App\Nova;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mostafaznv\NovaCkEditor\CkEditor;
use Intervention\Image\ImageManager;


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
    public static $title = 'name';
    public static $clickAction = 'select';


    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name','title'
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
            BelongsTo::make('Category', 'category', PreparationCategory::class)
                ->sortable()
                ->searchable()
                ->showCreateRelationButton()
                ->displayUsing(function ($category) {
                    return $category->getTranslation('name', app()->getLocale());
                }),
            Image::make('Image', 'image')
                ->disk('public')
                ->prunable()
                ->store(function ($request, $model, $attribute, $requestAttribute) {
                    $file = $request->file($requestAttribute);
                    if (!$file) return null;

                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $path = "preparation/$filename";

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
                Text::make('Name', 'name')
                    ->rules('max:255'),
                Text::make('Title', 'title')
                    ->rules('max:255'),
                CkEditor::make('Description', 'description'),
                Slug::make('Slug', 'slug')
                    ->from('Name')
                    ->separator('-')
                    ->rules('max:255')
                    ->creationRules('unique:preparations,Slug')
                    ->updateRules('unique:preparations,Slug,{{resourceId}}')
                    ->readonly(),
                Text::make('Image Alt Text', 'image_alt_text'),
            ])->setTitle('Name, Title, Description, Slug, Image Alt Text'),

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
