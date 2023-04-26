<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class task_type extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\task_type>
     */
    public static $model = \App\Models\task_type::class;

    public static $showColumnBorders = true;
    public static $clickAction = 'edit';
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
                Text::make('Title','title')->hideWhenCreating()->sortable()->withMeta([
                    'extraAttributes' => ['readonly'=>true]
                ]),
                Text::make('severity')->hideWhenCreating()->sortable()->withMeta([
                    'extraAttributes' => ['readonly'=>true]
                ]),
                //Text::make('type')->hideWhenCreating()->sortable(),
                Select::make('type')->options([
                    'Important'=> 'Important',
                    'Not Important'=> 'Not Important',
                    'Risky'=> 'Risky',
                    'Trash'=>'Trash',
                    'Processed'=>'Done'
               ])->displayUsingLabels()->sortable(),

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
