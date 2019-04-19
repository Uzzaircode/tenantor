<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class TenantsController extends Controller
{
    public function switch(Company $company) {
        
        session()->put('tenant', $company->uuid);

        return redirect('home');

    }
}
