<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tenants\Traits\forTenantTrait;

class Project extends Model
{

    use forTenantTrait;
    
    public function getConnectionName()
    {
        return 'tenant';
    }
}
