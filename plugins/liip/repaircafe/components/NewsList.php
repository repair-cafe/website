<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Liip\RepairCafe\Models\News;
use Liip\RepairCafe\Pagination\BootstrapFourPresenter;

class NewsList extends ComponentBase
{
    private $news;
    public $boostrap_four_presenter;

    public function componentDetails()
    {
        return [
            'name' => 'News List',
            'description' => 'Displays a list of news.'
        ];
    }

    public function onRun()
    {
        // set current locale
        $localeCode = Lang::getLocale();
        setlocale(LC_TIME, $localeCode . '_' . strtoupper($localeCode) . '.UTF-8');

        $newsPerPage = Config::get('liip.repaircafe::news_per_page', 9);
        $news = News::published()->currentLocale()->orderBy('publish_date', 'desc')->paginate($newsPerPage);
        $this->boostrap_four_presenter = new BootstrapFourPresenter($news);
        $this->news = $news;
    }

    public function getNews()
    {
        return $this->news;
    }
}
