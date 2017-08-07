<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
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
        $eventsGroupedByMonth = array();
        foreach ($events as $event) {
            $start = new \DateTime($event->start);
            $eventsGroupedByMonth[$start->format('Y')][$start->format('F')][] = $event;
        }

        return $eventsGroupedByMonth;
    }

    public function eventsGroupedByProximity()
    {
        // St. Gallen Location
        $lat = '47.42391';
        $lng = '9.37477';
        $distance = 100;

        $events = DB::select(
            DB::raw('SELECT *,( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(latitude) ) ) ) AS distance FROM liip_repaircafe_events HAVING distance < ' . $distance . ' ORDER BY distance')
        );

        return $events;

    }

    public function categories()
    {
        $category_options = array();
        $category_options[] = Lang::get('liip.repaircafe::lang.component.eventlist.all_categories');
        foreach ($this->categories as $category) {
            $category_options[$category->slug] = $category->name;
        }
        return $category_options;
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
            $query = Event::whereHas('categories', function ($filter) use ($category) {
                $filter->where('slug', '=', $category);
            })
            ->where(function ($searchFilter) use ($searchTerm) {
                $searchFilter->where('title', 'like', '%'.$searchTerm.'%')
                    ->orWhere('description', 'like', '%'.$searchTerm.'%');
            });
        } elseif (!empty($searchTerm)) {
            $query = Event::where('title', 'like', '%'.$searchTerm.'%')
                ->orWhere('description', 'like', '%'.$searchTerm.'%');
        } elseif (!empty($category)) {
            $query = Event::whereHas('categories', function ($filter) use ($category) {
                $filter->where('slug', '=', $category);
            });
        } else {
            $query = Event::query();
        }

        $query->whereHas('cafe', function ($cafe) {
            $cafe->where('is_published', true);
        });
        $query->where('is_published', true);
        $query->orderBy('start', 'asc');
        $events = $query->get();

        return $events;
    }
}
