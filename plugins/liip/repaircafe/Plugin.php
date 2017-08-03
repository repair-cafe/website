<?php namespace Liip\RepairCafe;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Liip\RepairCafe\Components\EventList' => 'eventList',
            'Liip\RepairCafe\Components\EventDetail' => 'eventDetail'
        ];
    }

    public function registerSettings()
    {
    }
}
