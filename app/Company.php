<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tenants\Traits\isTenantTrait;
use App\Tenants\Entities\TenantInterface;

class Company extends Model implements TenantInterface
{
    use isTenantTrait;

    protected $guarded = [];
}
