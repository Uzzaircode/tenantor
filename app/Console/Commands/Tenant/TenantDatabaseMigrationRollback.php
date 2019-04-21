<?php


namespace App\Console\Commands\Tenant;

use Illuminate\Console\Command;
use Illuminate\Database\Console\Migrations\RollbackCommand;
use Illuminate\Database\Migrations\Migrator;
use App\Tenants\Database\TenantDatabaseManager;
use App\Tenants\Traits\Console\FetchTenantsTrait;
use App\Tenants\Traits\Console\AcceptsMultipleTenantsTrait;

class TenantDatabaseMigrationRollback extends RollbackCommand
{
    use FetchTenantsTrait,AcceptsMultipleTenantsTrait;

    protected $migrator;
    protected $tenantDatabaseManager;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback tenants migrations ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Migrator $migrator, TenantDatabaseManager $tenantDatabaseManager)
    {
        
        parent::__construct($migrator);
        
        $this->setName('tenant:migrate-rollback');
        
        $this->tenantDatabaseManager = $tenantDatabaseManager;

        $this->specifyParameters();
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
       
        $this->getTenantId($this->option('tenants'))->each(function($tenant){
            
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
