<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Liip\RepairCafe\Models\Event;
use Liip\RepairCafe\Models\Settings;

class EventList extends ComponentBase
{
    private $cafe_slug;
    private $events_per_page;
    public $events_per_page_default;
    public $events;
    public $condensed;
    public $is_embedded;
    public $mapboxAccessToken;

    public function componentDetails()
    {
        return [
            'name'        => 'liip.repaircafe::lang.component.eventlist.details.name',
            'description' => 'liip.repaircafe::lang.component.eventlist.details.description',
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
            'is_embedded' => [
                'title'             => 'liip.repaircafe::lang.component.eventlist.properties.is_embedded.title',
                'description'       => 'liip.repaircafe::lang.component.eventlist.properties.is_embedded.description',
                'type'              => 'checkbox',
            ],
            'events_per_page' => [
                'title'             => 'liip.repaircafe::lang.component.eventlist.properties.events_per_page.title',
                'description'       => 'liip.repaircafe::lang.component.eventlist.properties.events_per_page.description',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'liip.repaircafe::lang.component.eventlist.properties.events_per_page.validationMessage',
            ],
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
                    'description' => $category['description'],
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
        $this->is_embedded = boolval($this->property('is_embedded'));
        $this->events_per_page_default = Settings::get('events_per_page', 15);
        if (!empty(Input::get('events_per_page'))) {
            // if GET/POST parameter is set
            $this->events_per_page = Input::get('events_per_page');
        } elseif (!empty($this->property('events_per_page'))) {
            // if component property is set
            $this->events_per_page = $this->property('events_per_page');
        } else {
            // if none of the following are set use default configuration from settings
            $this->events_per_page = $this->events_per_page_default;
        }
        $this->cafe_slug = $this->property('cafe_slug');
        $this->events = $this->queryEvents();
        $this->mapboxAccessToken = \json_encode(Settings::get('mapbox_access_token', ''));
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

        if (!empty($this->cafe_slug)) {
            $query->where('cafe_slug', $this->cafe_slug);
        }

        $indexedResults = $query->distinct()->get(['event_id']);
        $event_ids = array();
        foreach ($indexedResults as $indexedResult) {
            array_push($event_ids, $indexedResult->event_id);
        }
        $event_query = Event::query();
        $event_query->whereIn($event_query->getModel()->getQualifiedKeyName(), $event_ids);
        $event_query->orderBy('start', 'asc');
        $events = $event_query->paginate($this->events_per_page);
        $events->appends(['category' => $category, 'searchterm' => $searchTerm, 'events_per_page' => (!empty(Input::get('events_per_page')) ? $this->events_per_page : null)]);

        return $events;
    }
}
