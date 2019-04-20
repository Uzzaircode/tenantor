<?php

namespace App\Events\Tenant;


use Illuminate\Queue\SerializesModels;

use Illuminate\Foundation\Events\Dispatchable;
use App\Tenants\Entities\TenantInterface;

class TenantCreatedEvent
{
    use Dispatchable, SerializesModels;

    public $tenant;
   
    public function __construct(TenantInterface $tenant)
    {
        $this->tenant = $tenant;
    }

}
