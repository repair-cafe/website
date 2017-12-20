<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Liip\RepairCafe\Models\Cafe;
use Liip\RepairCafe\Models\Settings;

class CafeList extends ComponentBase
{
    private $cafes;
    public $cafe_count;

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
        $this->cafes = $cafes;
        $this->cafe_count = Cafe::published()->count();
    }
}
