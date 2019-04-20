<?php
namespace App\Tenants\Traits;

trait forTenantTrait
{

    public function getConnectionName()
    {
        return 'tenant';
    }
}
