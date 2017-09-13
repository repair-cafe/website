<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Event;
use Liip\RepairCafe\Models\News;
use October\Rain\Support\Facades\Html;

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
        $this->page['news'] = $this->news; // add news object to page context to make seo manager work
        $this->page->title = $this->news->title; // overwrite page title

        // set default seo values if not set
        Event::listen('seo.beforeComponentRender', function ($page, $seoTag) {
            if (empty($seoTag->meta_description)) {
                $seoTag->meta_description = str_limit(Html::strip($this->news->lead), 157);
            }
            if (empty($seoTag->og_image)) {
                $seoTag->og_image = $this->news->image;
                list($width, $height) = $this->getOgImageDimensions($seoTag->og_image);
                $seoTag->og_image_width = $width;
                $seoTag->og_image_height = $height;
            }
        });

        if (!$this->news) {
            return \Response::make($this->controller->run('404'), 404);
        }
    }

    protected function getOgImageDimensions($og_image)
    {
        $filePath = base_path(config('cms.storage.media.path') . $og_image);

        if (is_file($filePath)) {
            return getimagesize($filePath);
        }
        return false;
    }
}
