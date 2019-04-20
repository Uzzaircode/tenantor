<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use App\Events\Tenant\TenantCreatedEvent;

class CompaniesController extends Controller
{

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $company = Company::make([
            'name' => $request->name,
        ]);

        auth()->user()->companies()->save($company);

        event(new TenantCreatedEvent($company));
        
        return redirect()->route('tenants.switch', $company);
    }

}
