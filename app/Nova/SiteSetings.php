<?php

namespace App\Nova;

use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;


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
                    Image::make('Logo', 'logo')
                        ->disk('public')
                        ->path('Logo')
                        ->store(function (Request $request) {
                            $file = $request->file('logo');

                            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();

                            $file->storeAs('Logo', $filename, 'public');

                            return $filename;
                        })
                        ->preview(function ($value, $disk) {
                            return $value
                                ? Storage::disk($disk)->url('Logo/' . $value)
                                : null;
                        })
                        ->thumbnail(function ($value, $disk) {
                            return $value
                                ? Storage::disk($disk)->url('Logo/' . $value)
                                : null;
                        })
                        ->rules('nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'),

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
                    NovaTabTranslatable::make([
                        Trix::make('About Us', 'about_us')
                            ->rules('required')
                    ])
                ]),
                Tab::make('Mission', [
                    NovaTabTranslatable::make([
                        Trix::make('Mission', 'mission')
                            ->rules('required')
                    ])
                ]),
                Tab::make('Vision', [
                    NovaTabTranslatable::make([
                        Trix::make('Vision', 'vision')
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
