<?php

namespace App\Providers;
use Doctrine\DBAL\Types\Type;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Type::addType('timestamp', 'Doctrine\DBAL\Types\TimestampType');
    }
}
