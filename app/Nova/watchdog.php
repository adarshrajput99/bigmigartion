<?php

namespace App\Nova;

use Acme\Analytics\Analytics;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Cards\MyHtmlCard;
use Degecko\NovaFiltersSummary\FiltersSummary;
use PharIo\Manifest\Url;
use Illuminate\Support\HtmlString;
class watchdog extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\watchdog>
     */
    public static $model = \App\Models\watchdog::class;

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
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        //['wid','uid','type','message','variable','severity','link',
        //'location','referer','hostname','timestamp'];

        return [
            ID::make()->sortable(),
            Text::make('wid')->sortable(),
            Text::make('uid')->sortable(),
            Text::make('type')->sortable(),
            Text::make('message')->hideFromIndex()->asHtml()->sortable(),
            Text::make('variable')->sortable(),
            Text::make('severity')->sortable(),
            Text::make('link')->sortable(),
            Text::make('location')->hideFromIndex()->sortable(),
            Text::make('referer')->hideFromIndex()->sortable(),
            Text::make('hostname')->hideFromIndex()->sortable(),
            Text::make('timestamp')->sortable(),
            Text::make('rhid')->sortable(),
            Text::make('profile_id')->sortable(),
            Text::make('entity_id')->sortable(),
            Text::make('Processed'),
            Text::make('order_id')->sortable(),
            Text::make('created')->sortable(),
            Text::make('log_type')->hideFromIndex()->sortable(),
            Text::make('service_type')->hideFromIndex()->sortable(),
            
            
            
            
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [

            (new MyHtmlCard()), // Required
            (FiltersSummary::make())->stacked(),


            //(new NovaHtmlCard())->width('1/3'),
            //(new NovaHtmlCard())->width('1/3')->markdown('# Hello World!'),
            //(new NovaHtmlCard())->width('1/3')->view('cards.hello', ['name' => 'World']),
        ];

    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new \App\Nova\Filters\watchdog()
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
