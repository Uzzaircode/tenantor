<?php

namespace App\Tenants\Database;

use App\Tenants\Entities\TenantInterface;
use Illuminate\Database\DatabaseManager;

class TenantDatabaseManager{

    protected $databaseManager;

    public function __construct(DatabaseManager $databaseManager){
        
        $this->databaseManager = $databaseManager;
    }



    public function createConnection(TenantInterface $tenant){
        
       config()->set('database.connections.tenant',$this->getTenantConnection($tenant));

    }


    public function connectToTenant(){

        $this->databaseManager->reconnect('tenant');

    }

    public function purgeTenantConnection(){
        $this->databaseManager->purge('tenant');
    }

    protected function getTenantConnection(TenantInterface $tenant){
        
        return array_merge(
            config()->get($this->getConfigConnectionPath()),
            $tenant->tenantConnection->only('database')
        
        );

    }


    protected function getConfigConnectionPath(){
        
        return sprintf('database.connections.%s',$this->getDefaultConnectionName());

    }



    protected function getDefaultConnectionName(){

        return config('database.default');
    }
}