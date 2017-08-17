<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Lang;
use Liip\RepairCafe\Models\News;

class NewsList extends ComponentBase
{
    public $news;

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

        $this->news = News::published()->currentLocale()->orderBy('publish_date', 'desc')->get();
    }

    public function getNews()
    {
        return $this->news;
    }
}
