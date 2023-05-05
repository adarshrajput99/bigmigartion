<?php

namespace App\Nova;


use Laravel\Nova\Fields\ID;

use Laravel\Nova\Fields\Date;
use Oneduo\NovaTimeField\Time;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Text;
use NormanHuth\NovaRadioField\Radio;
use Formfeed\DependablePanel\DependablePanel;

use Laravel\Nova\Http\Requests\NovaRequest;
use DB;

class rules extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\rules>
     */
    public static $model = \App\Models\rules::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

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
        return [
            ID::make()->sortable(),
            Select::make('Event Type','event_type')->options([
                'Important'=> 'Important',
                'Not Important'=> 'Not Important',
                'Risky'=> 'Risky',
                'Trash'=>'Trash'
           ])->displayUsingLabels()->sortable(),

        Select::make('Title', 'title')
        ->dependsOn(
        ['event_type'],
        function (Select $field, NovaRequest $request, FormData $formData) {

                $titles = DB::table('task_types')->where('type', $formData->event_type)->pluck('title');
                $options = $titles->mapWithKeys(function ($title) {
                    return [$title => $title];
                })->toArray();
                $field->options($options);

        }
    ),

    Radio::make(__('Range Based Frequency'), 'frequency_check')
    ->options([
        0 => __('No'),
        1 => __('Yes'),



    ]),

            Text::make('Event Duration', 'event_duration')
            ->sortable()->hideWhenCreating()
            ,
            Date::make('Event Duration', 'event_duration')
            ->sortable()->sortable()->hideFromDetail()->hideFromIndex()->hideWhenUpdating()
            ,
           Time::make('From','event_from')->readonly(false),
           Time::make('To','event_to')->nullable()->readonly(false),
            Number::make('Occurrence','occurence')->sortable(),

        DependablePanel::make('Panel Title', [
            Number::make('From','From_freq'),
            Number::make('To','To_freq')->sortable(),
            Select::make('Frequency', 'frequency')
            ->dependsOn(
            ['frequency_check'],
            function (Select $field, NovaRequest $request, FormData $formData) {

                    if($formData->frequency_check ){
                        return $field->readonly(false)->options([
                            'Minute'=> 'Minute',
                            'Hour'=> 'Hour',
                            'Day'=> 'Day',
                            'Month'=>'Month',
                            'None'=>'Execute Only once Choose the duration'
                    ])->displayUsingLabels()->sortable();
                    }

            }),
        ])->hide()
        ->dependsOn(["frequency_check"], function (DependablePanel $panel, NovaRequest $request, FormData $formData) {
            if ($formData->frequency_check ) {
                $formData->event_duration = null;

                $panel->show();
            }
        }),
            //Number::make('Frequency','frequency')->sortable(),
            // Select::make('Frequency','frequency')->,
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
