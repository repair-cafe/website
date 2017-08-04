<?php namespace Liip\RepairCafe;

use Liip\RepairCafe\Console\Seed;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function register()
    {
        $this->registerConsoleCommand('repaircafe:seed', Seed::class);
    }

    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }
}
