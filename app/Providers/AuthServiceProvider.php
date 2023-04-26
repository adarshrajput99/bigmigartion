<?php

namespace App\Providers;
use App\Nova\Dashboards\executive;
use App\Policies\ExecutiveDashboardPolicy;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ExecutiveDashboardPolicy::class => ExecutiveDashboardPolicy::class,
            ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
