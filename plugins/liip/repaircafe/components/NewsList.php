<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Lang;
use Liip\RepairCafe\Models\News;
use Liip\RepairCafe\Models\Settings;

class NewsList extends ComponentBase
{
    private $news;
    private $max_items;

    public function componentDetails()
    {
        return [
            'name'        => 'liip.repaircafe::lang.component.newslist.details.name',
            'description' => 'liip.repaircafe::lang.component.newslist.details.description',
        ];
    }

    public function defineProperties()
    {
        return [
            'max_items' => [
                'title'             => 'liip.repaircafe::lang.component.newslist.properties.max_items.title',
                'description'       => 'liip.repaircafe::lang.component.newslist.properties.max_items.description',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'liip.repaircafe::lang.component.newslist.properties.max_items.validationMessage',
            ],
        ];
    }

    public function onRun()
    {
        // set current locale
        $localeCode = Lang::getLocale();
        setlocale(LC_TIME, $localeCode . '_' . strtoupper($localeCode) . '.UTF-8');

        $newsPerPage = Settings::get('news_per_page', 9);
        $this->max_items = $this->property('max_items');

        $newsQuery = News::published()->currentLocale()->orderBy('publish_date', 'desc');
        if (!empty($this->max_items)) {
            $news = $newsQuery->take(intval($this->max_items))->get();
        } else {
            $news = $newsQuery->paginate($newsPerPage);
        }
        $this->news = $news;
    }

    public function getNews()
    {
        return $this->news;
    }
}
