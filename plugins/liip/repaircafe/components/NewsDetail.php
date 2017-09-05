<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Liip\RepairCafe\Models\News;

class NewsDetail extends ComponentBase
{
    public $news;

    public function componentDetails()
    {
        return [
            'name'        => 'liip.repaircafe::lang.component.news_detail.details.name',
            'description' => 'liip.repaircafe::lang.component.news_detail.details.description',
        ];
    }

    public function onRun()
    {
        $this->news = News::published()->where('slug', $this->param('slug'))->first();
        if (!$this->news) {
            return \Response::make($this->controller->run('404'), 404);
        }
    }
}
