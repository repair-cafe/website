<?php namespace Liip\RepairCafe\Console;

use Illuminate\Console\Command;
use Liip\RepairCafe\Seeds\NewsSeed;
use Liip\RepairCafe\Seeds\UserRoles;
use Liip\RepairCafe\Seeds\Users;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Liip\RepairCafe\Seeds\CafesSeed;
use Liip\RepairCafe\Seeds\MasterData;

class Seed extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'repaircafe:seed';

    /**
     * @var string The console command description.
     */
    protected $description = 'This command seeds the cafe data into the plugin';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        if ($this->option('userroles')) {
            $userRoleData = new UserRoles();

            $userRoleData->seedUserRoles();
            $this->output->writeln('All Roles created');
        }

        if ($this->option('users')) {
            $userData = new Users();

            $userData->seedUserData();
            $this->output->writeln('All Users created');
        }

        if ($this->option('masterdata')) {
            $masterData = new MasterData();

            $masterData->seedSettingsData();
            $this->output->writeln('All Settings set');
            $masterData->seedCategoryData();
            $this->output->writeln('All Categories created');
            $masterData->seedLocaleData();
            $this->output->writeln('All Locales created');
        }

        if ($this->option('dummydata')) {
            $cafes = new CafesSeed();
            $cafes->seedCafeData();
            $this->output->writeln('All Cafes created');
            $cafes = new NewsSeed();
            $cafes->seedNewsData();
            $this->output->writeln('All News created');
        }
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
        return [
            [
                'userroles',
                'userroles',
                InputOption::VALUE_NONE,
                'Activate this option to seed roles (repaircafeOwner, contentManager)'
            ],
            [
                'users',
                'users',
                InputOption::VALUE_NONE,
                'Activate this option to seed default-users'
            ],
            [
                'masterdata',
                'master',
                InputOption::VALUE_NONE,
                'Activate this option to seed master-data (e.g. categories)'
            ],
            [
                'dummydata',
                'dummy',
                InputOption::VALUE_NONE,
                'Activate this option to seed dummy-data (e.g. cafes, contacts, events)'
            ]
        ];
    }
}
