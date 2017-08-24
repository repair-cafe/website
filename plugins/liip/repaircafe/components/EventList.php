<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Liip\RepairCafe\Models\Event;
use Liip\RepairCafe\Models\Settings;
use Liip\RepairCafe\Pagination\BootstrapFourPresenter;

class EventList extends ComponentBase
{
    private $cafe_slug;
    public $events;
    public $condensed;
    public $eventPaginator;
    public $mapboxAccessToken;

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
                'title'             => 'liip.repaircafe::lang.component.eventlist.properties.cafe_slug.title',
                'description'       => 'liip.repaircafe::lang.component.eventlist.properties.cafe_slug.description',
                'type'              => 'string',
            ],
            'condensed' => [
                'title'             => 'liip.repaircafe::lang.component.eventlist.properties.condensed.title',
                'description'       => 'liip.repaircafe::lang.component.eventlist.properties.condensed.description',
                'type'              => 'checkbox',
            ],
            'events_per_page' => [
                'title'             => 'liip.repaircafe::lang.component.eventlist.properties.events_per_page.title',
                'description'       => 'liip.repaircafe::lang.component.eventlist.properties.events_per_page.description',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'liip.repaircafe::lang.component.eventlist.properties.events_per_page.validationMessage',
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

    public function eventsForMap()
    {
        $eventsForMap = [];
        foreach ($this->events as $event) {
            $categories = array_map(function ($category) {
                return [
                    'name' => $category['name'],
                    'slug' => $category['slug'],
                ];
            }, $event->categories->toArray());
            $eventsForMap[] = array(
                'id' => $event->id,
                'title' => $event->getTitle(),
                'date' => $event->getFormattedDate(),
                'address' => $event->getFormattedAddress(),
                'latitude' => $event->latitude,
                'longitude' => $event->longitude,
                'categories' => $categories,
            );
        }
        return \json_encode($eventsForMap);
    }

    public function onRun()
    {
        // set current locale
        $localeCode = Lang::getLocale();
        setlocale(LC_TIME, $localeCode . '_' . strtoupper($localeCode) . '.UTF-8');

        $this->condensed = boolval($this->property('condensed'));
        $this->cafe_slug = $this->property('cafe_slug');
        $this->events = $this->queryEvents();
        $this->mapboxAccessToken = Settings::get('mapbox_access_token', '');
    }

    protected function queryEvents()
    {
        $category = Input::get('category');
        $searchTerm = Input::get('searchterm');
        $eventsPerPage = Settings::get('events_per_page', 15);
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

        if (!empty($this->cafe_slug)) {
            $query->where('cafe_slug', $this->cafe_slug);
        }

        $indexedResults = $query->distinct()->get(['event_id']);
        $event_ids = array_map(function ($indexedResult) {
            return $indexedResult->event_id;
        }, $indexedResults);
        $event_query = Event::query();
        $event_query->whereIn($event_query->getModel()->getQualifiedKeyName(), $event_ids);
        $event_query->orderBy('start', 'asc');
        $events = $event_query->paginate($eventsPerPage);
        $events->appends(['category' => $category, 'searchterm' => $searchTerm]);
        $this->eventPaginator = new BootstrapFourPresenter($events);

        return $events;
    }
}
