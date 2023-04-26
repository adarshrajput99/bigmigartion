<?php

namespace App\Nova\Dashboards;
use Laravel\Nova\Nova;

use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;
use App\Nova\Cards\MyHtmlCard;
class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function navigation()
{
    

    return [
        // your navigation menu items here
        [
            'label' => 'Welcome, ' . $user->name,
            'url' => Nova::path(),
            'canSee' => function ($request) {
                return $request->user()->can('viewDashboard', $this);
            },
        ],
    ];
}

    public function cards()
    {
        
            return [

            ];
        
        
    }
}
