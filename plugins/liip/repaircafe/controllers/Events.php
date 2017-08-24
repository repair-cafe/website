<?php namespace Liip\RepairCafe\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Liip\RepairCafe\Models\Event;
use October\Rain\Support\Facades\Flash;

class Events extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ReorderController'
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'liip.repaircafe.events'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Liip.RepairCafe', 'main-menu-cafe', 'side-menu-events');
    }

    public function onDuplicate()
    {
        $original_event_id = Input::get('event_id');

        $original_event_model = Event::find($original_event_id);
        $cafe_model = $original_event_model->cafe();

        if ($original_event_model && $cafe_model) {
            // create new model with copied data
            $event_model = new Event();
            $event_model->cafe_id = $original_event_model->cafe_id;
            $event_model->description = $original_event_model->description;
            $event_model->title = $original_event_model->title;
            $event_model->start = $original_event_model->start;
            $event_model->end = $original_event_model->end;
            $event_model->street = $original_event_model->street;
            $event_model->zip = $original_event_model->zip;
            $event_model->city = $original_event_model->city;
            $event_model->latitude = $original_event_model->latitude;
            $event_model->longitude = $original_event_model->longitude;
            $event_model->save();

            // save relations
            $cafe_model->events[] = $event_model;
            foreach ($original_event_model->categories()->get() as $category) {
                $event_model->categories()->attach($category);
            }

            $event_id = $event_model->getAttribute('id');
            Flash::success(Lang::get(
                'liip.repaircafe::lang.event.duplicate_success',
                ['eventname' => $event_model->title]
            ));
            return Redirect::to('/backend/liip/repaircafe/events/update/' . $event_id);
        } else {
            Flash::error(Lang::get(
                'liip.repaircafe::lang.event.duplicate_error',
                ['eventname' => $original_event_model->title]
            ));
        }
    }
}
