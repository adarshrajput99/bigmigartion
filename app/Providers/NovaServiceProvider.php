<?php

namespace App\Providers;
use Route;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Silvanite\NovaToolPermissions\NovaToolPermissions;
use Sereny\NovaPermissions\NovaPermissions;
//use Illuminate\Http\Request;
use App\Nova\asrcard;
class NovaServiceProvider extends NovaApplicationServiceProvider
{

    private $user_authority;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::serving(function () {
            $user = request()->user();

            if ($user) {
                $name = $user->Authority;
                $this->$user_authority= $name;
                // Do something with the user's name here
            }
        });
        //$this->getCustomMenu();

    
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
        //$user = request()->user();
        if($this->$user_authority >0){
            return [
                new \App\Nova\Dashboards\Main,
            ];
        }
        return [
          
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
                MenuSection::dashboard(Main::class)
            ];
        });
    }
   

    }
