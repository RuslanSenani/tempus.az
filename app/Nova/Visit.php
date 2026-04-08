<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
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

    public static $perPageOptions = [25, 50, 100, 150, 200, 250, 500, 1000];

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
            Badge::make('Səbəb', 'reason', function () {
                // Əgər bazada reason yoxdursa (NULL), onu 'NORMAL' statusuna çeviririk
                return $this->reason ?: 'NORMAL';
            })
                ->map([
                    'NORMAL' => 'success', // Yaşıl
                    'RECURRING_BLOCK_TRY' => 'danger',  // Qırmızı
                    'EMPTY_OR_SHORT_UA' => 'warning', // Narıncı
                    'MALICIOUS_AGENT' => 'danger',  // Qırmızı
                    'HACKING_ATTEMPT' => 'danger',  // Qırmızı
                    'FAKE_BROWSER_NO_OS' => 'warning', // Narıncı
                    'PROGRAMMATIC_BOT' => 'warning', // Narıncı
                    'TOO_MANY_REQUESTS' => 'info',    // Göy
                ])
                ->labels([
                    'NORMAL' => 'Normal Giriş',
                    'RECURRING_BLOCK_TRY' => 'Bloklu İP Təkrarı',
                    'EMPTY_OR_SHORT_UA' => 'Şübhəli Başlıq (UA)',
                    'MALICIOUS_AGENT' => 'Zərərli Bot',
                    'HACKING_ATTEMPT' => 'Hücum Cəhdi',
                    'FAKE_BROWSER_NO_OS' => 'Saxta Brauzer',
                    'PROGRAMMATIC_BOT' => 'Avtomat Skript',
                    'TOO_MANY_REQUESTS' => 'Limit Aşıldı',
                ])
                ->sortable(),
            Number::make('Sorgu Sayı', 'request_count')->sortable(),
            // Bot olub-olmadığını rəngli nişanla göstərək
            Badge::make('Status', function () {
                // 1. Əgər botdursa və heç bir qayda pozmayıbsa (reason boşdursa) -> Yaxşı Bot
                if ($this->is_bot && empty($this->reason)) {
                    return 'friendly_bot';
                }

                // 2. Əgər həm botdursa, həm də reason (səbəb) varsa -> Pis Bot / Hücumçu
                if ($this->is_bot && !empty($this->reason)) {
                    return 'malicious_bot';
                }

                // 3. Əgər bot deyilsə -> Real İnsan
                return 'human';
            })
                ->map([
                    'friendly_bot' => 'info',    // Göy rəng (Yaxşı botlar üçün)
                    'malicious_bot' => 'danger',  // Qırmızı rəng (Hücumçular üçün)
                    'human' => 'success', // Yaşıl rəng (İnsanlar üçün)
                ])
                ->labels([
                    'friendly_bot' => 'Faydalı Bot',
                    'malicious_bot' => 'Zərərli Bot / Hücum',
                    'human' => 'Real İnsan',
                ])
                ->icons([
                    'info' => 'search',             // Axtarış ikonu
                    'danger' => 'exclamation-circle', // Xəbərdarlıq ikonu
                    'success' => 'user',               // İnsan ikonu
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

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }
}
