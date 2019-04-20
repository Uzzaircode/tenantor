<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Tenants\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use App\Console\Commands\Tenant\TenantDatabaseMigratorCommand;
use App\Tenants\Database\TenantDatabaseManager;


class TenantServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
     
    public function register()
    {
        $this->app->singleton(TenantDatabaseMigratorCommand::class,function($app){
            return new TenantDatabaseMigratorCommand(
                $app->make('migrator'), 
                $app->make(TenantDatabaseManager::class)
        );
        });
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
