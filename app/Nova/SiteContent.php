<?php

namespace App\Nova;


use Illuminate\Http\Request;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SiteContent extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\SiteContent>
     */
    public static $model = \App\Models\SiteContent::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static $clickAction = 'select';

    public static $perPageOptions = [25, 50, 100, 150, 200, 250, 500, 1000];


    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'key', 'value'
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
            Text::make('Key', 'key')
                ->rules('required', 'max:255')
                ->creationRules('unique:site_contents,key')
                ->updateRules('unique:site_contents,key,{{resourceId}}')
                ->sortable()
                ->readonly(),
            NovaTabTranslatable::make([
                Text::make('Value', 'value')
                    ->rules('required')
            ])->setTitle('Value'),


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
        return [
            (new Actions\SyncLanguages)->standalone(), // standalone() düyməni yuxarıda, tək göstərir
        ];
    }

    public static function label()
    {
        return __('SiteContents');
    }


    public static function singularLabel()
    {
        return __('SiteContent');
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

}
