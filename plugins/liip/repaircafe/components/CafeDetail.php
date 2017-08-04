<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Liip\RepairCafe\Models\Cafe;

class CafeDetail extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Cafe Detail',
            'description' => 'Displays details of a cafe.'
        ];
    }

    // This array becomes available on the page as {{ component.cafe }}
    public function cafe()
    {
        return Cafe::where('slug', $this->param('slug'))->first();
    }
}
