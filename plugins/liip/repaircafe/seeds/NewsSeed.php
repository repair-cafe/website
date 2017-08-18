<?php namespace Liip\RepairCafe\Seeds;

use Liip\RepairCafe\Models\News;
use October\Rain\Parse\Yaml;

class NewsSeed
{
    public static function seedNewsData()
    {
        $yaml = new Yaml();
        $news = $yaml->parseFile(dirname(__FILE__).'/News.yaml');

        foreach ($news as $news_entry) {
            $news_model = new News();

            $news_model->fill($news_entry);
            $news_model->save();
        }
    }
}
