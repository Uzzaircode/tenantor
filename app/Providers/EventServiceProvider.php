<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        'App\Events\Tenant\TenantCreatedEvent' => [
            'App\Listeners\Tenant\CreateTenantDatabaseListener' 
        ],

        'App\Events\Tenant\TenantIdentifiedEvent' => [
            'App\Listeners\Tenant\RegisterTenantListener' 
        ],

        'App\Events\Tenant\TenantDatabaseCreatedEvent' => [
            'App\Listeners\Tenant\SetupTenantDatabaseListener' 
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
