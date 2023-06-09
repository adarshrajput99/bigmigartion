<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Date;
use Oneduo\NovaTimeField\Time;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\FormData;
class rule_status extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\rule_status>
     */
    public static $model = \App\Models\rule_status::class;

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
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {


        return [
            ID::make()->sortable(),
            Select::make('Event Type','event_type')->options([
                'Important'=> 'Important',
                'Not Important'=> 'Not Important',
                'Risky'=> 'Risky',
                'Trash'=>'Trash'
           ])->displayUsingLabels()->sortable(),
           Text::make('Event Duration', 'event_duration')
           ->sortable()->hideWhenCreating()
           ,
           Date::make('Event Duration', 'event_duration')
           ->sortable()->sortable()->hideFromDetail()->hideFromIndex()->hideWhenUpdating()
           ,            Time::make('From','event_from'),
            Time::make('To','event_to'),

            Number::make('Occurrence','occurence')->sortable(),
            Number::make('Frequency','frequency')->sortable(),
            //Number::make('Frequency','frequency')->sortable(),
            Text::make('Last executed','last_executed')->sortable(),
            Text::make('Frequency enabled','frequency_check')->sortable(),
            Text::make('From freq','From_freq')->sortable(),
            Text::make('To freq','To_freq')->sortable(),
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
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
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
