<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Input;
use Liip\RepairCafe\Models\Category;
use Liip\RepairCafe\Models\Event;

class EventList extends ComponentBase
{
    private $categories;

    public function componentDetails()
    {
        return [
            'name' => 'Event List',
            'description' => 'Displays a list of events.'
        ];
    }

    // This array becomes available on the page as {{ component.eventsGroupedByMonth }}
    public function eventsGroupedByMonth()
    {
        $events = $this->queryEvents();
        return array(
            'August' => $events,
            'September' => $events,
        );
    }

    public function categories()
    {
        return $this->categories;
    }

    public function onRun()
    {
        $this->events = $this->queryEvents();
        $this->categories = Category::all();
    }

    protected function queryEvents()
    {
        $category = Input::get('category');
        $searchTerm = Input::get('searchterm');

        if (!empty($searchTerm) && !empty($category)) {
            $events = Event::whereHas('categories', function ($filter) use ($category) {
                $filter->where('slug', '=', $category);
            })
            ->where(function ($searchFilter) use ($searchTerm) {
                $searchFilter->where('title', 'like', '%'.$searchTerm.'%')
                    ->orWhere('description', 'like', '%'.$searchTerm.'%');
            })->get();
        } elseif (!empty($searchTerm)) {
            $events = Event::where('title', 'like', '%'.$searchTerm.'%')
                ->orWhere('description', 'like', '%'.$searchTerm.'%')->get();
        } elseif (!empty($category)) {
            $events = Event::whereHas('categories', function ($filter) use ($category) {
                $filter->where('slug', '=', $category);
            })->get();
        } else {
            $events = Event::all();
        }
        return $events;
    }
}
