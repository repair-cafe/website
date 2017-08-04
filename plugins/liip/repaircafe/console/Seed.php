<?php namespace Liip\RepairCafe\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Liip\RepairCafe\Seeds\Cafes;
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
    public function fire()
    {

        if ($this->option('masterdata')) {
            $masterData = new MasterData();
            $masterData->seedLinkTypeData();
            $this->output->writeln('All LinkTypes created');

            $masterData->seedCategoryData();
            $this->output->writeln('All Categories created');
        }

        if ($this->option('dummydata')) {
            $cafes = new Cafes();
            $cafes->seedCafeData();
            $this->output->writeln('All Cafes created');
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
