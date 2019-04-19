<?php

namespace App\Tenants;

use App\Tenants\Entities\TenantInterface;

class Manager
{
    protected $tenant;

    public function setTenant(TenantInterface $tenant)
    {
        $this->tenant = $tenant;
    }

    public function getTenant()
    {

        return $this->tenant;
    }


    public function hasTenant(){
        
        return isset($this->tenant);
    }
}
