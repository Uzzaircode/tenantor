<?php

namespace App\Tenants\Traits\Console;

use App\Company;

trait FetchTenantsTrait
{

    public function getTenantId($ids = null)
    {
        $tenants = Company::query();

        if ($ids) {

            $tenants = $tenants->whereIn('id', $ids);
        }

        return $tenants;
    }

}
