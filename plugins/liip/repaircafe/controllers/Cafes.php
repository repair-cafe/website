<?php namespace Liip\RepairCafe\Controllers;

use Backend\Behaviors\RelationController;
use Backend\Classes\Controller;
use BackendMenu;

class Cafes extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController',
        RelationController::class];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = [
        'repaircafe.cafes'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Liip.RepairCafe', 'main-menu-cafe', 'side-menu-cafes');
    }
}
