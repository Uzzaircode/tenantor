<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Tenants\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Manager::class, function(){
            return new Manager();
        });

        Request::macro('tenant',function(){
           return app(Manager::class)->getTenant();
        });

        Blade::if('tenant',function(){
            return app(Manager::class)->hasTenant();
        });
    }
}
