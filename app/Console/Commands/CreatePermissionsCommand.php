<?php

namespace App\Console\Commands;

use Database\Seeders\PermissionSeeder;
use Illuminate\Console\Command;

class CreatePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Permissions for all models';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $seeder = new PermissionSeeder();
        $seeder->run();
    }
}
