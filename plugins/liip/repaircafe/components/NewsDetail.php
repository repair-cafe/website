<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Liip\RepairCafe\Models\News;

class NewsDetail extends ComponentBase
{
    public $news;

    public function componentDetails()
    {
        return [
            'name' => 'News Detail',
            'description' => 'Displays details of a news.'
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
