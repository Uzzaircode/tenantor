<?php

namespace App\Listeners\Tenant;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Tenant\TenantIdentifiedEvent;
use App\Tenants\Manager;
use App\Tenants\Database\TenantDatabaseManager;

class RegisterTenantListener
{
    
    protected $tenantDatabaseManager;

    public function __construct(TenantDatabaseManager $tenantDatabaseManager){
        
        $this->tenantDatabaseManager = $tenantDatabaseManager;

    }


    public function handle(TenantIdentifiedEvent $event)
    {
        app(Manager::class)->setTenant($event->tenant);

       $this->tenantDatabaseManager->createConnection($event->tenant);
    }
}
