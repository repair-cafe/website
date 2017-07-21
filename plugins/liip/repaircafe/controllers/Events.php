<?php namespace Liip\RepairCafe\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Events extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'repaircafes.events'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Liip.RepairCafe', 'main-menu-events');
    }

    public function listExtendQuery($query)
    {
        $query->byUser()->get();
    }

    public function formExtendQuery($query)
    {
        $query->byUser()->get();
    }
}
