<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Liip\RepairCafe\Models\Cafe;
use Liip\RepairCafe\Models\Settings;
use Liip\RepairCafe\Pagination\BootstrapFourPresenter;

class CafeList extends ComponentBase
{
    private $cafes;
    public $cafe_count;
    public $cafe_paginator;

    public function componentDetails()
    {
        return [
            'name' => 'Cafe List',
            'description' => 'Displays a list of cafes.'
        ];
    }

    public function getCafes()
    {
        return $this->cafes;
    }

    public function onRun()
    {
        $cafesPerPage = Settings::get('cafes_per_page', 15);
        $cafesQuery = Cafe::published()->orderBy('title', 'asc');
        $cafes = $cafesQuery->paginate($cafesPerPage);
        $this->cafe_paginator = new BootstrapFourPresenter($cafes);
        $this->cafes = $cafes;
        $this->cafe_count = Cafe::published()->count();
    }
}
