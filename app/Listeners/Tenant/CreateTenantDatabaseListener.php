<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Tenants\Database\TenantDatabaseGenerator;

class CreateTenantDatabaseListener
{

    protected $tenantDatabaseGenerator;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(TenantDatabaseGenerator $tenantDatabaseGenerator)
    {
        $this->tenantDatabaseGenerator = $tenantDatabaseGenerator;
    }

    /**
     * Handle the event.
     *
     * @param  TenantCreatedEvent  $event
     * @return void
     */
    public function handle(TenantCreatedEvent $event)
    {
        if(!$this->tenantDatabaseGenerator->create($event->tenant)){
            
            throw new \Exception('Tenant DB can\'t be generated');

        }
    }
}
