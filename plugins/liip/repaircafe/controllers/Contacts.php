<?php namespace Liip\RepairCafe\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;

class Contacts extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ReorderController',
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'liip.repaircafe.cafes'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Liip.RepairCafe', 'cafe', 'cafes');
    }
}
