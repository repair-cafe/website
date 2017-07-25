<?php namespace Liip\RepairCafe;

use Liip\Repaircafe\Components\EventList;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            EventList::class => 'eventList'
        ];
    }

    public function registerSettings()
    {
    }
}
