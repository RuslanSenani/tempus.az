<?php

namespace App\Nova;

use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Illuminate\Http\Request;
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

class SiteSetings extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Setting>
     */
    public static $model = \App\Models\Setting::class;

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
     * @return bool
     */

    public static function authorizedToCreate(Request $request)
    {
        return static::newModel()->count() === 0;
    }

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }


    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Tabs::make('Ayarlar', [
                Tab::make('Sayt Məlumatları', [
                    Text::make('Telefon 1', 'phone_1')
                        ->rules('required')
                        ->onlyOnForms(),
                    Text::make('Telefon 2', 'phone_2')
                        ->onlyOnForms(),
                    Text::make('Fax 1', 'fax_1')
                        ->rules('required')
                        ->onlyOnForms(),
                    Text::make('Fax 2', 'fax_2')
                        ->onlyOnForms(),
                    Image::make('Image', 'logo')
                        ->disk('public')
                        ->prunable()
                        ->store(function ($request, $model, $attribute, $requestAttribute) {
                            $file = $request->file($requestAttribute);
                            if (!$file) return null;
                            if ($model->logo && Storage::disk('public')->exists($model->logo)) {
                                Storage::disk('public')->delete($model->logo);
                            }
                            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                            $path = "Logo/$filename";

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
                        Text::make('Company Name', 'company_name')
                            ->rules('required')
                            ->onlyOnForms(),
                        Text::make('Address', 'address')
                            ->rules('required')
                    ]),
                ]),
                Tab::make('Social Media', [
                    Text::make('E-mail', 'email'),
                    Text::make('Facebook', 'facebook'),
                    Text::make('Instagram', 'instagram'),
                    Text::make('Tik Tok', 'tik_tok'),
                    Text::make('Youtube', 'youtube'),
                ]),
                Tab::make('About Us', [
                    Image::make('Logo 1', 'logo1')
                        ->disk('public')
                        ->prunable()
                        ->store(function ($request, $model, $attribute, $requestAttribute) {
                            $file = $request->file($requestAttribute);
                            if (!$file) return null;
                            if ($model->logo1 && Storage::disk('public')->exists($model->logo1)) {
                                Storage::disk('public')->delete($model->logo1);
                            }
                            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                            $path = "Logo/$filename";

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
                    Image::make('Logo 2', 'logo2')
                        ->disk('public')
                        ->prunable()
                        ->store(function ($request, $model, $attribute, $requestAttribute) {
                            $file = $request->file($requestAttribute);
                            if (!$file) return null;
                            if ($model->logo2 && Storage::disk('public')->exists($model->logo2)) {
                                Storage::disk('public')->delete($model->logo2);
                            }
                            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                            $path = "Logo/$filename";

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
                        CkEditor::make('About Us', 'about_us')
                            ->rules('required')->fullWidth()
                    ])
                ]),
                Tab::make('Mission', [

                    Image::make('Mission Vission Logo', 'mission_vision_logo')
                        ->disk('public')
                        ->prunable()
                        ->store(function ($request, $model, $attribute, $requestAttribute) {
                            $file = $request->file($requestAttribute);
                            if (!$file) return null;
                            if ($model->mission_vision_logo && Storage::disk('public')->exists($model->mission_vision_logo)) {
                                Storage::disk('public')->delete($model->mission_vision_logo);
                            }
                            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                            $path = "Logo/$filename";

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
                        CkEditor::make('Mission', 'mission')
                            ->rules('required')
                    ])
                ]),
                Tab::make('Vision', [
                    NovaTabTranslatable::make([
                        CkEditor::make('Vision', 'vision')
                            ->rules('required')
                    ])
                ]),
                Tab::make('Our Activities', [

                    Image::make('Activities Logo', 'activities_logo')
                        ->disk('public')
                        ->prunable()
                        ->rules( 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048')
                        ->store(function ($request, $model, $attribute, $requestAttribute) {

                            $file = $request->file($requestAttribute);
                            if (!$file) return null;
                            if ($model->activities_logo && Storage::disk('public')->exists($model->activities_logo)) {
                                Storage::disk('public')->delete($model->activities_logo);
                            }
                            $extension = $file->getClientOriginalExtension();
                            $filename = Str::uuid() . '.' . $extension;
                            $path = "Logo/$filename";

                            $manager = new ImageManager(new Driver());

                            if ($extension === 'gif') {
                                Storage::disk('public')->put($path, $file->get());
                            } else {
                                $image = $manager->read($file)
                                    ->pad(800, 600, 'ffffff');

                                Storage::disk('public')->put($path, $image->toJpeg(80));
                            }

                            return [$attribute => $path];
                        }),

                    NovaTabTranslatable::make([
                        CkEditor::make('activities', 'activities')
                            ->rules('required')
                    ])
                ]),
                Tab::make('Our Values', [
                    NovaTabTranslatable::make([
                        CkEditor::make('values', 'values')
                            ->rules('required')
                    ])
                ]),
                Tab::make('Our History', [
                    NovaTabTranslatable::make([
                        CkEditor::make('history', 'history')
                            ->rules('required')
                    ])
                ]),
                Tab::make('Advantages', [
                    NovaTabTranslatable::make([
                        CkEditor::make('advantages', 'advantages')
                            ->rules('required')
                    ])
                ]),
                Tab::make('Results and Achievements', [
                    NovaTabTranslatable::make([
                        CkEditor::make('results_achievements', 'results_achievements')
                            ->rules('required')
                    ])
                ]),
                Tab::make('Team', [
                    NovaTabTranslatable::make([
                        CkEditor::make('team', 'team')
                            ->rules('required')
                    ])
                ]),
                Tab::make('Activity Zone', [
                    Image::make('Active Zone Logo', 'active_zone_logo')
                        ->disk('public')
                        ->prunable()
                        ->store(function ($request, $model, $attribute, $requestAttribute) {
                            $file = $request->file($requestAttribute);
                            if (!$file) return null;
                            if ($model->active_zone_logo && Storage::disk('public')->exists($model->active_zone_logo)) {
                                Storage::disk('public')->delete($model->active_zone_logo);
                            }
                            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                            $path = "Logo/$filename";

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
                        CkEditor::make('activity_zone', 'activity_zone')
                            ->rules('required')
                    ])
                ])
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
