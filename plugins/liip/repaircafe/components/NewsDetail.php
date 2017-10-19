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

    public function defineProperties()
    {
        return [
            'slug' => [
                'title' => 'liip.repaircafe::lang.component.news_detail.properties.slug.title',
                'description' => 'liip.repaircafe::lang.component.news_detail.properties.slug.description',
                'default' => '{{ :slug }}',
                'type' => 'string',
            ],
        ];
    }

    public function onRun()
    {
        $this->news = News::published()->where('slug', $this->property('slug'))->first();
        if (!$this->news) {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }
        $this->page['news'] = $this->news; // add news object to page context to make seo manager work
        $this->page->title = $this->news->title; // overwrite page title
    }
}
