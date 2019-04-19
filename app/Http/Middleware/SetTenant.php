<?php

namespace App\Http\Middleware;

use Closure;
use App\Company;
use App\Events\Tenant\TenantIdentifiedEvent;

class SetTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $tenant;

    public function handle($request, Closure $next)
    {
        $tenant = $this->resolveTenant(session('tenant'));

        if(!$tenant){
            
            return $next($request);

        }

        if(!auth()->user()->companies->contains('id', $tenant->id)){
            
            return redirect('home');

        }

        event(new TenantIdentifiedEvent($tenant));
        
        return $next($request);
    }

    protected function resolveTenant($uuid){

        return Company::where('uuid', $uuid)->first();
    }
}
