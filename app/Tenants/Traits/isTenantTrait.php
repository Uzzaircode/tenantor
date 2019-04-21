<?php

namespace App\Tenants\Traits;

use App\TenantConnection;
use App\Tenants\Entities\TenantInterface;
use Illuminate\Support\Str;
use App\TenantUser;

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
        
        return new TenantUser([
            'database' => 'tenant_'. $tenant->id,
        ]);
    }

    public function tenantConnection()
    {
        return $this->hasOne(TenantUser::class, 'user_id', 'id');
    }
}
