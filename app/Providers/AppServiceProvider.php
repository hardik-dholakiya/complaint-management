<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Hesto\MultiAuth\MultiAuthServiceProvider');
        }
        $this->app->bind('App\Repository\Interfaces\ComplaintRepositoryInterface', 'App\Repository\ComplaintRepository');
        $this->app->bind('App\Repository\Interfaces\UserRepositoryInterface', 'App\Repository\UserRepository');
        $this->app->bind('App\Repository\Interfaces\AdminRepositoryInterface', 'App\Repository\AdminRepository');
        $this->app->bind('App\Repository\Interfaces\ResponseRepositoryInterface', 'App\Repository\ResponseRepository');
    }
}
