<?php namespace Liip\RepairCafe\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class LinkType extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'repaircafe.linktypes' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Liip.RepairCafe', 'main-menu-coffee', 'side-menu-linktypes');
    }
}