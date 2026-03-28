<?php

namespace App\Nova;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mostafaznv\NovaCkEditor\CkEditor;
use Intervention\Image\ImageManager;
use Outl1ne\MultiselectField\Multiselect;


class Preparation extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Preparation>
     */
    public static $model = \App\Models\Preparation::class;


    public static $relatableSearchResults = 1000;
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
        'id', 'name', 'title', 'slug'
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
            Multiselect::make('Category', 'category_id') // 'category' əvəzinə 'category_id' yazırıq
            ->sortable()
                ->options(\App\Models\PreparationCategory::all()->mapWithKeys(function ($category) {
                    return [
                        $category->id => $category->getTranslation('name', app()->getLocale())
                    ];
                }))
                ->singleSelect()
                ->displayUsing(function ($value) {
                    $category = \App\Models\PreparationCategory::find($value);
                    return $category ? $category->getTranslation('name', app()->getLocale()) : "-";
                })
                ->resolveUsing(function ($value) {
                    return $value;
                }),
            Image::make('Image', 'image')
                ->disk('public')
                ->prunable()
                ->deletable()
                ->store(function ($request, $model, $attribute, $requestAttribute) {
                    $file = $request->file($requestAttribute);
                    if (!$file) return null;

                    $oldImage = $model->getOriginal($attribute);

                    if ($oldImage && Storage::disk('public')->exists($oldImage)) {

                        Storage::disk('public')->delete($oldImage);
                    }


                    $filename = Str::uuid() . '.jpg';
                    $path = "preparation/$filename";


                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($file)->pad(800, 600, 'ffffff');

                    Storage::disk('public')->put($path, $image->toJpeg(80));

                    return [
                        $attribute => $path,
                    ];
                }),
//            Image::make('Image', 'image')
//                ->disk('public')
//                ->prunable()
//                ->deletable()
//                ->store(function ($request, $model, $attribute, $requestAttribute) {
//                    $file = $request->file($requestAttribute);
//                    if (!$file) return null;
//                    if ($model->image && Storage::disk('public')->exists($model->image)) {
//                        Storage::disk('public')->delete($model->image);
//                    }
//                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
//                    $path = "preparation/$filename";
//
//                    // Version 3-də yeni Manager yaradılır
//                    $manager = new ImageManager(new Driver());
//
//                    // Şəkli oxuyuruq və ölçüləndiririk
//                    $image = $manager->read($file)
//                        ->pad(800, 600, 'ffffff');
//
//                    // Şəkli formatlayıb Storage-a yazırıq
//                    Storage::disk('public')->put($path, $image->toJpeg(80));
//
//                    return [
//                        $attribute => $path,
//                    ];
//                }),
            Image::make('Official Document', 'official_document')
                ->disk('public')
                ->prunable()
                ->deletable()
                ->store(function ($request, $model, $attribute, $requestAttribute) {
                    $file = $request->file($requestAttribute);
                    if (!$file) return null;
                    if ($model->image && Storage::disk('public')->exists($model->image)) {
                        Storage::disk('public')->delete($model->image);
                    }
                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $path = "preparation/$filename";

                    $manager = new ImageManager(new Driver());

                    $image = $manager->read($file);

                    $encoded = $image->toJpeg(100);

                    Storage::disk('public')->put($path, (string)$encoded);

                    return [
                        $attribute => $path,
                    ];
                }),


            NovaTabTranslatable::make([


                File::make('PDF Sənəd', 'pdf')
                    ->disk('public')
                    ->path('preparations/pdfs')
                    ->prunable()
                    ->deletable()
                    ->acceptedTypes('.pdf')
                    ->preview(function ($value, $disk) {
                        return $value
                            ? Storage::disk($disk)->url($value)
                            : null;
                    })
                    ->displayUsing(function ($value) {
                        return $value ? ' PDF-ə bax' : 'Yoxdur';
                    })
                    ->rules('nullable', 'mimes:pdf'),

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
                Slug::make('Image Alt Text', 'image_alt_text')
                    ->from('Name')
                    ->separator('-')
                    ->readonly(),
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

    /**
     * Modulun cəm halda adı (Sol menyuda görünən əsas ad)
     */
    public static function label()
    {
        return __('Preparatlar');
    }

    /**
     * Modulun tək halda adı (Məsələn: "Create Preparat" hissəsindəki "Preparat")
     */
    public static function singularLabel()
    {
        return __('Preparat');
    }

    /**
     * Yeni qeyd yaradarkən düymənin üstündəki yazı
     */
    public static function createButtonLabel()
    {
        return __('Yeni :resource Yarat', ['resource' => static::singularLabel()]);
    }

    /**
     * Yeniləyərkən düymənin üstündəki yazı
     */
    public static function updateButtonLabel()
    {
        return __(':resource Yenilə', ['resource' => static::singularLabel()]);
    }
}
