<?php

namespace App\Listeners\Tenant;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Tenant\TenantIdentifiedEvent;
use App\Tenants\Manager;

class RegisterTenantListener
{
    
    /**
     * Handle the event.
     *
     * @param  TenantIdentifiedEvent  $event
     * @return void
     */
    public function handle(TenantIdentifiedEvent $event)
    {
        return app(Manager::class)->setTenant($event->tenant);
    }
}
