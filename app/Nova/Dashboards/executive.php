<?php

namespace App\Nova\Dashboards;
use App\Nova\Cards\MyHtmlCard;

use Laravel\Nova\Dashboard;

class executive extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            (new MyHtmlCard()), // Required
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'executive';
    }
}
