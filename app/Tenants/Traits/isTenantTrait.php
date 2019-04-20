<?php

namespace App\Tenants\Traits;

use App\TenantConnection;
use App\Tenants\Entities\TenantInterface;
use Illuminate\Support\Str;

trait isTenantTrait
{

    public static function boot()
    {
        parent::boot();

        static::creating(function($tenant){
            $tenant->uuid = (string) Str::uuid();
        });

        static::created(function($tenant){
                $tenant->tenantConnection()->save(static::newDatabaseConnection($tenant));
        });
    }

    protected static function newDatabaseConnection(TenantInterface $tenant){
        
        return new TenantConnection([
            'database' => 'tenant_'. $tenant->id,
        ]);
    }

    public function tenantConnection()
    {
        return $this->hasOne(TenantConnection::class, 'company_id', 'id');
    }
}
