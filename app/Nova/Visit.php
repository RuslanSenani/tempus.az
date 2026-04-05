<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Visit extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Visit>
     */
    public static $model = \App\Models\Visit::class;

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
        'id', 'ip_address'
    ];

    public static function group()
    {
        return __('Other');
    }

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

            Text::make('IP Ünvanı', 'ip_address')
                ->sortable()
                ->copyable(),

            // Bot olub-olmadığını rəngli nişanla göstərək
            Badge::make('Status', 'is_bot')
                ->map([
                    true => 'danger',
                    false => 'success',
                ])
                ->labels([
                    true => 'Bot / Hücum',
                    false => 'Real İnsan',
                ])
                ->icons([
                    'danger' => 'exclamation-circle',
                    'success' => 'check-circle',
                ]),

            Text::make('Brauzer / OS', function () {
                return "{$this->browser} ({$this->os})";
            })->onlyOnIndex(),

            Text::make('Girdiyi Səhifə', 'url')
                ->displayUsing(fn($url) => str_replace($request->getSchemeAndHttpHost(), '', $url))
                ->copyable(),

            DateTime::make('Tarix', 'created_at')
                ->displayUsing(fn($value) => $value ? $value->format('H:i:s - d.m.Y') : '-')
                ->sortable(),
            DateTime::make('Son Giriş', 'updated_at')
                ->displayUsing(fn($value) => $value ? $value->format('H:i:s - d.m.Y') : '-')
                ->sortable(),

            Text::make('User Agent', 'user_agent')->hideFromIndex(),
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
        return [new Filters\BotFilter];
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
        return [
            new Actions\UnblockIP
        ];
    }

    public static function label()
    {
        return __('Visitors');
    }


    public static function singularLabel()
    {
        return __('Visitor');
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
