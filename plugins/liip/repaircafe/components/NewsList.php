<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Liip\RepairCafe\Models\News;
use Liip\RepairCafe\Pagination\BootstrapFourPresenter;

class NewsList extends ComponentBase
{
    private $news;
    public $newsPaginator;
    private $max_items;

    public function componentDetails()
    {
        return [
            'name' => 'News List',
            'description' => 'Displays a list of news.'
        ];
    }

    public function defineProperties()
    {
        return [
            'max_items' => [
                'title'             => 'Max Items',
                'description'       => 'Maximum items which should be shown',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'The Max Items property can contain only numeric symbols'
            ],
        ];
    }

    public function onRun()
    {
        // set current locale
        $localeCode = Lang::getLocale();
        setlocale(LC_TIME, $localeCode . '_' . strtoupper($localeCode) . '.UTF-8');

        $newsPerPage = Config::get('liip.repaircafe::news_per_page', 9);
        $this->max_items = $this->property('max_items');

        $newsQuery = News::published()->currentLocale()->orderBy('publish_date', 'desc');
        if (!empty($this->max_items)) {
            $news = $newsQuery->take(intval($this->max_items))->get();
        } else {
            $news = $newsQuery->paginate($newsPerPage);
            $this->newsPaginator = new BootstrapFourPresenter($news);
        }
        $this->news = $news;
    }

    public function getNews()
    {
        return $this->news;
    }
}
