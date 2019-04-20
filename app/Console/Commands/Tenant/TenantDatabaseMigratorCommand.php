<?php

namespace App\Console\Commands\Tenant;

use Illuminate\Console\Command;
use Illuminate\Database\Console\Migrations\MigrateCommand;
use Illuminate\Database\Migrations\Migrator;
use App\Company;
use App\Tenants\Database\TenantDatabaseManager;

class TenantDatabaseMigratorCommand extends MigrateCommand
{

    protected $migrator;
    protected $tenantDatabaseManager;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run tenants migrations ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Migrator $migrator, TenantDatabaseManager $tenantDatabaseManager)
    {
        
        parent::__construct($migrator);
        
        $this->setName('tenant:migrate');
        
        $this->tenantDatabaseManager = $tenantDatabaseManager;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if(!$this->confirmToProceed()){
            return;
        }

        $this->input->setOption('database', 'tenant');

        $tenants = Company::get();

        $tenants->each(function($tenant){
            
            $this->tenantDatabaseManager->createConnection($tenant);
            $this->tenantDatabaseManager->connectToTenant();
            parent::handle();
            $this->tenantDatabaseManager->purgeTenantConnection();

        });      

        
    }


    protected function getMigrationPaths()
    {
        return [database_path('migrations/tenant')];
    }
}
