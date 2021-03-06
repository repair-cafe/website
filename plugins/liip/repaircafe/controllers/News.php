<?php namespace Liip\RepairCafe\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;

class News extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'liip.repaircafe.news'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Liip.RepairCafe', 'news');
    }
}
