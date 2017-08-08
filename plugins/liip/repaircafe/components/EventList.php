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
    private $cafe_slug;
    public $events;
    public $condensed;

    public function componentDetails()
    {
        return [
            'name' => 'Event List',
            'description' => 'Displays a list of events.'
        ];
    }

    public function defineProperties()
    {
        return [
            'cafe_slug' => [
                'title'             => 'Cafe Slug',
                'description'       => 'Filter events by cafe',
                'type'              => 'string',
            ],
            'condensed' => [
                'title'             => 'Condensed style',
                'description'       => 'More compact list style',
                'type'              => 'checkbox',
            ]
        ];
    }

    // This array becomes available on the page as {{ component.eventsGroupedByMonth }}
    public function eventsGroupedByMonth()
    {
        $eventsGroupedByMonth = array();
        foreach ($this->events as $event) {
            $start = new \DateTime($event->start);
            $eventsGroupedByMonth[$start->format('Y')][$start->format('F')][] = $event;
        }

        return $eventsGroupedByMonth;
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
        $this->categories = Category::all();
        $this->condensed = boolval($this->property('condensed'));
        $this->cafe_slug = $this->property('cafe_slug');
        $this->events = $this->queryEvents();
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
            if (!empty($this->cafe_slug)) {
                $cafe->where('slug', $this->cafe_slug);
            }
            $cafe->where('is_published', true);
        });
        $query->where('is_published', true);
        $query->where(function($query) {
            $query->whereNotNull('end');
            $query->where('end', '>=', DB::raw('now()'));
        });
        $query->orWhere(function($query) {
            $query->whereNull('end');
            $query->where('start', '>=', DB::raw('now()'));
        });
        $query->orderBy('start', 'asc');
        $events = $query->get();

        return $events;
    }
}
