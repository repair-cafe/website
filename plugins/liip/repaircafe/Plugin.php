<?php namespace Liip\RepairCafe;

use Backend\Models\User as BackendUserModel;
use Backend\Controllers\Users as BackendUsersController;
use Illuminate\Support\Facades\Event;
use Liip\RepairCafe\Console\Seed;
use Liip\RepairCafe\Models\Cafe;
use Liip\RepairCafe\Models\News;
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
            'Liip\RepairCafe\Components\CafeList' => 'cafeList',
            'Liip\RepairCafe\Components\CafeDetail' => 'cafeDetail',
            'Liip\RepairCafe\Components\NewsList' => 'newsList',
            'Liip\RepairCafe\Components\NewsDetail' => 'newsDetail',
        ];
    }

    /**
     * Register snippets with the RainLab.Pages plugin.
     *
     * @return array
     * @see https://octobercms.com/plugin/rainlab-pages
     */
    public function registerPageSnippets()
    {
        return [
            'Liip\RepairCafe\Components\Button' => 'button',
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

    public function boot()
    {
        BackendUserModel::extend(function ($model) {
            $model->belongsToMany['cafes'] = [
                Cafe::class,
                'table' => 'liip_repaircafe_cafe_user'
            ];

            $model->addDynamicMethod('hasRole', function ($role) use ($model) {
                return $model->groups()->whereName($role)->exists();
            });

            $model->addDynamicMethod('isRepairCafeAdmin', function () use ($model) {
                return $model->hasRole('owners') || $model->hasRole('contentManager');
            });
        });

        BackendUsersController::extendFormFields(function ($form, $model, $context) {
            if (!$model instanceof BackendUserModel) {
                return;
            }

            $form->addTabFields([
                'cafes' => [
                    'label'   => 'liip.repaircafe::lang.user.tab.cafe_label',
                    'comment' => 'liip.repaircafe::lang.user.tab.cafe_comment',
                    'type' => 'relation',
                    'list' => '$/liip/repaircafe/models/cafe/columns.yaml',
                    'nameFrom' => 'title',
                    'tab' => 'liip.repaircafe::lang.user.tab.cafes'
                ],
            ]);
        });

        // Remove complex content blocks from pages plugin
        Event::listen('pages.content.templateList', function ($plugin, $templates) {
            $ignoredTemplates = [
                'cafe-embed-description.htm',
                'cafe-embed-description.fr.htm',
                'cafe-embed-description.it.htm',
            ];
            $templates->forget($ignoredTemplates);
            return $templates;
        });

        // Overwrite default buttons of richeditor
        Event::listen('backend.form.extendFields', function ($form) {
            foreach ($form->getFields() as $field) {
                if (!empty($field->config['type']) && str_contains($field->config['type'], 'richeditor')) {
                    $form->addJs('/plugins/liip/repaircafe/assets/js/froala.defaultButtons.js', 'Liip.RepairCafe');
                    break;
                }
            }
        });

        Event::listen('pages.menuitem.listTypes', function () {
            return [
                'liip-repaircafe-cafe' => 'liip.repaircafe::lang.menuitem.cafe',
                'liip-repaircafe-all-cafes' => 'liip.repaircafe::lang.menuitem.all_cafes',
                'liip-repaircafe-news' => 'liip.repaircafe::lang.menuitem.news',
                'liip-repaircafe-all-news' => 'liip.repaircafe::lang.menuitem.all_news',
            ];
        });

        Event::listen('pages.menuitem.getTypeInfo', function ($type) {
            if ($type === 'liip-repaircafe-cafe' || $type === 'liip-repaircafe-all-cafes') {
                return Cafe::getMenuTypeInfo($type);
            }
            if ($type === 'liip-repaircafe-news' || $type === 'liip-repaircafe-all-news') {
                return News::getMenuTypeInfo($type);
            }
        });

        Event::listen('pages.menuitem.resolveItem', function ($type, $item, $url, $theme) {
            if ($type === 'liip-repaircafe-cafe' || $type === 'liip-repaircafe-all-cafes') {
                return Cafe::resolveMenuItem($item, $url, $theme);
            }
            if ($type === 'liip-repaircafe-news' || $type === 'liip-repaircafe-all-news') {
                return News::resolveMenuItem($item, $url, $theme);
            }
        });
    }
}
