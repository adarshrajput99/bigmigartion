<?php

namespace App\Providers;
use Route;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Silvanite\NovaToolPermissions\NovaToolPermissions;
use Sereny\NovaPermissions\NovaPermissions;
use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Menu\MenuItem;
use App\Nova\Dashboards\Main;
use App\Nova\asrcard;
use Illuminate\Support\Facades\Blade;

class NovaServiceProvider extends NovaApplicationServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::footer(function($request){
            return Blade::render('nova/footer');
        });
       $this->getCustomMenu();
}



    /**
     * Register the Nova routes.
     *
     * @return void
     */
    /*
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();


    }*/

    public function routes($middleware = ['web'])
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
                /*
        Route::namespace('App\Nova\Http\Controllers\Auth')
            ->middleware($middleware)
            ->as('nova.')
            ->prefix(Nova::path())
            ->group(function () {
                Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
                Route::post('login', 'Auth\LoginController@login');
                //Route::get('/login', 'LoginController@showLoginForm');
                //Route::post('/login', 'LoginController@login')->name('login');
            });*/
        }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
           /* return in_array($user->email, [
                //
            ]);
        */});
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {

        return [
            new \App\Nova\Dashboards\Main,

        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [

        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    private function getCustomMenu(){

        Nova::mainMenu(function (Request $request){
            return [
               MenuSection::dashboard(Main::class)->icon('chart-bar'),
                MenuSection::make('Records',[
                    MenuItem::make('Watchdog','/resources/watchdogs'),
                    MenuItem::make('Task','/resources/task_types'),

                ])->icon('check-circle')->collapsable(),
                MenuSection::make('Rules',[
                    MenuItem::make('Create Rules','/resources/rules/new'),
                    MenuItem::make('Registerd Rules','/resources/rules'),
                    MenuItem::make('Status','/resources/rule_statuses'),
                    MenuItem::make('Logs','/resources/logs_rules'),

                ])->icon('chip')->collapsable(),
                MenuSection::make('Users',[
                    MenuItem::make('Users','/resources/user'),

                ])->icon('user')->collapsable()
            ];
        });
    }


    }
