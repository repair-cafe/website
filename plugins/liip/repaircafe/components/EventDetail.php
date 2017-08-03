<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Liip\RepairCafe\Models\Event;

class EventDetail extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Event Detail',
            'description' => 'Displays details of an event.'
        ];
    }

    // This array becomes available on the page as {{ component.event }}
    public function event()
    {
        return Event::find($this->param('id'));
    }
}
