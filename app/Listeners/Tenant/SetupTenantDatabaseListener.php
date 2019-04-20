<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantDatabaseCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Artisan;

class SetupTenantDatabaseListener
{
   
    /**
     * Handle the event.
     *
     * @param  TenantDatabaseCreatedEvent  $event
     * @return void
     */
    public function handle(TenantDatabaseCreatedEvent $event)
    {
        Artisan::call('tenant:migrate',[
            '--tenants' => [$event->tenant->id]
        ]);
    }
}
