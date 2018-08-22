<?php namespace Liip\RepairCafe\Console;

use Illuminate\Console\Command;
use Liip\RepairCafe\Seeds\UserRoles;

class MigrateUserRoles extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'repaircafe:migrateUserRoles';

    /**
     * @var string The console command description.
     */
    protected $description = 'This command migrates existing user groups to roles';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $userRoleData = new UserRoles();
        $userRoleData->seedUserRoles();
        $this->output->writeln('All Roles created and assigned to Users with existing Groups');
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
