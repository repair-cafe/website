<?php namespace Liip\RepairCafe\Controllers;

use Backend\Behaviors\RelationController;
use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;

class Cafes extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController',
        RelationController::class];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = [
        'liip.repaircafe.cafes'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Liip.RepairCafe', 'main-menu-cafe', 'side-menu-cafes');
    }

    public function listExtendQuery($query)
    {
        return $query->authorized();
    }

    public function formExtendQuery($query)
    {
        return $query->authorized();
    }
}
