<?php

namespace App\Tenants\Database;

use App\Tenants\Entities\TenantInterface;
use DB;

class TenantDatabaseGenerator{

    public function create(TenantInterface $tenant){

        return DB::statement("
        
            CREATE DATABASE tenant_{$tenant->id}

        ");

    }
}