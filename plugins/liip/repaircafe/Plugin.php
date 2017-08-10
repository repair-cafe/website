<?php namespace Liip\RepairCafe;

use Liip\RepairCafe\Console\Seed;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['RainLab.Translate', 'RainLab.Pages'];

    public function register()
    {
        $this->registerConsoleCommand('repaircafe:seed', Seed::class);
    }

    public function registerComponents()
    {
        return [
            'Liip\RepairCafe\Components\EventList' => 'eventList',
            'Liip\RepairCafe\Components\CafeDetail' => 'cafeDetail'
        ];
    }

    public function registerSettings()
    {
    }
}
