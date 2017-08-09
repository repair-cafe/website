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
            // group events by the first of each month in a certain year
            $eventsGroupedByMonth[$start->format('Y-m-01')][] = $event;
        }

        return $eventsGroupedByMonth;
    }

    public function categories()
    {
        $category_options = array();
        $category_options[] = '- ' . Lang::get('liip.repaircafe::lang.component.eventlist.all_categories') . ' -';
        foreach ($this->categories as $category) {
            $category_options[$category->slug] = $category->name;
        }
        return $category_options;
    }

    public function onRun()
    {
        $this->categories = Category::orderBy('name', 'asc')->get();
        $this->condensed = boolval($this->property('condensed'));
        $this->cafe_slug = $this->property('cafe_slug');
        $this->events = $this->queryEvents();
    }

    protected function queryEvents()
    {
        $category = Input::get('category');
        $searchTerm = Input::get('searchterm');
        $query = Db::table('liip_repaircafe_search_index_view');

        if (!empty($searchTerm)) {
            $query->where('value', 'like', '%'.$searchTerm.'%');
        }
        if (!empty($category)) {
            $query->where('category_slug', $category);
        }

        $query->where(function ($query) {
            $query->where('event_date', '>=', DB::raw('now()'));
        });

        $indexedResults = $query->distinct()->get(['event_id']);
        $event_ids = array_map(function ($indexedResult) {
            return $indexedResult->event_id;
        }, $indexedResults);
        $event_query = Event::query();
        $event_query->whereIn($event_query->getModel()->getQualifiedKeyName(), $event_ids);
        $event_query->orderBy('start', 'asc');
        $events = $event_query->get();

        return $events;
    }
}
