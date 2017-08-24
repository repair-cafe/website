<?php namespace Liip\RepairCafe;

use Liip\RepairCafe\Console\Seed;
use RainLab\Translate\Classes\Translator;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['RainLab.Translate', 'RainLab.Pages'];

    public function register()
    {
        $this->registerConsoleCommand('repaircafe:seed', Seed::class);
    }

    public function registerComponents()
    {
        return [
            'Liip\RepairCafe\Components\EventList' => 'eventList',
            'Liip\RepairCafe\Components\CategoryList' => 'categoryList',
            'Liip\RepairCafe\Components\CafeDetail' => 'cafeDetail',
            'Liip\RepairCafe\Components\NewsList' => 'newsList',
            'Liip\RepairCafe\Components\NewsDetail' => 'newsDetail',
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'liip.repaircafe::lang.settings.label',
                'description' => 'liip.repaircafe::lang.settings.description',
                'category'    => 'system::lang.system.categories.misc',
                'icon'        => 'icon-coffee',
                'class'       => 'Liip\RepairCafe\Models\Settings',
                'order'       => 500,
                'keywords'    => 'repaircafe reperatur',
                'permissions' => ['liip.repaircafe.settings']
            ]
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'localizeddate_formatted' => [$this, 'localizeddateFormatted'],
            ],
        ];
    }

    public function localizeddateFormatted($date, $format, $locale = '')
    {
        if (function_exists('twig_localized_date_filter')) {
            if (empty($locale)) {
                $translate = Translator::instance();
                $locale = $translate->getLocale();
            }
            $twig = $this->app->make('twig.environment');
            return twig_localized_date_filter($twig, $date, 'none', 'none', $locale, null, $format);
        }

        return $date;
    }
}
