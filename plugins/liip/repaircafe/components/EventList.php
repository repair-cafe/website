<?php namespace Liip\Events\Components;

use Cms\Classes\ComponentBase;
use Liip\Events\Models\Event;

class EventList extends ComponentBase
{
    public $events;

    public function componentDetails()
    {
        return [
            'name'        => 'EventList Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'name' => [
                'label' => 'Name',
                'type' => 'string'
            ]
        ];
    }

    public function onRun()
    {
        $this->events = Event::published()->get();
    }

}
