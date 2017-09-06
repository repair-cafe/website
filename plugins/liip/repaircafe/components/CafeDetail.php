<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Liip\RepairCafe\Models\Cafe;

class CafeDetail extends ComponentBase
{
    public $cafe;

    public function componentDetails()
    {
        return [
            'name'        => 'liip.repaircafe::lang.component.cafe_detail.details.name',
            'description' => 'liip.repaircafe::lang.component.cafe_detail.details.description',
        ];
    }

    public function onRun()
    {
        $this->cafe = Cafe::published()->where('slug', $this->param('slug'))->first();
        if (!$this->cafe || !$this->cafe->is_published) {
            return \Response::make($this->controller->run('404'), 404);
        }
    }
}
