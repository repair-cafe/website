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

    public function defineProperties()
    {
        return [
            'slug' => [
                'title' => 'liip.repaircafe::lang.component.cafe_detail.properties.slug.title',
                'description' => 'liip.repaircafe::lang.component.cafe_detail.properties.slug.description',
                'default' => '{{ :slug }}',
                'type' => 'string',
            ],
        ];
    }

    public function onRun()
    {
        $this->cafe = Cafe::published()->where('slug', $this->property('slug'))->first();
        if (!$this->cafe) {
            return \Response::make($this->controller->run('404'), 404);
        }
    }
}
