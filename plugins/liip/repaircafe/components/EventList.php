<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Liip\RepairCafe\Models\Event;

class EventList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Event List',
            'description' => 'Displays a list of events.'
        ];
    }

    // This array becomes available on the page as {{ component.events }}
    public function events()
    {
        return Event::all();
    }
}
