<?php namespace Liip\RepairCafe;

use Backend\Models\User as BackendUserModel;
use Backend\Controllers\Users as BackendUsersController;
use Illuminate\Support\Facades\Event;
use Liip\RepairCafe\Console\MigrateUserRoles;
use Liip\RepairCafe\Console\Seed;
use Liip\RepairCafe\Models\Cafe;
use Liip\RepairCafe\Models\News;
use October\Rain\Support\Facades\Html;
use RainLab\Translate\Classes\Translator;
use System\Classes\MediaLibrary;
use System\Classes\PluginBase;
use Backend\Facades\BackendAuth;

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
            'Liip\RepairCafe\Components\Button' => 'button', // we need to add button as component to make snippets work everywhere
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
        // Set default paginator template
        \Illuminate\Pagination\AbstractPaginator::defaultView("pagination::bootstrap-4");
        \Illuminate\Pagination\AbstractPaginator::defaultSimpleView("pagination::simple-bootstrap-4");

        BackendUserModel::extend(function ($model) {
            $model->belongsToMany['cafes'] = [
                Cafe::class,
                'table' => 'liip_repaircafe_cafe_user'
            ];
        });

        BackendUsersController::extendFormFields(function ($form, $model, $context) {
            if (!$model instanceof BackendUserModel) {
                return;
            }
            $backend_user = BackendAuth::getUser();
            if ($backend_user->is_superuser) {
                $form->addTabFields([
                    'cafes' => [
                        'label' => 'liip.repaircafe::lang.user.tab.cafe_label',
                        'comment' => 'liip.repaircafe::lang.user.tab.cafe_comment',
                        'type' => 'relation',
                        'list' => '$/liip/repaircafe/models/cafe/columns.yaml',
                        'nameFrom' => 'title',
                        'tab' => 'liip.repaircafe::lang.user.tab.cafes'
                    ],
                ]);
            }
        });

        // Change backend menu order of pages plugin
        Event::listen('backend.menu.extendItems', function ($manager) {
            $manager->addMainMenuItems('RainLab.Pages', [
                'pages' => [
                    'order' => '110',
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

        // set default seo values if not set
        Event::listen('seo.beforeComponentRender', function ($page, $seoTag) {
            $metaDescription = '';
            // currently og_image only works with images from the media manager
            $ogImage = '';

            if (!empty($page['news'])) {
                // if current page uses newsDetail component
                if (!empty($page['news']->lead)) {
                    $metaDescription = $page['news']->lead;
                }
                if (!empty($page['news']->image)) {
                    $ogImage = $page['news']->image;
                }
            } elseif (!empty($page['cafe'])) {
                // if current page uses cafeDetail component
                if (!empty($page['cafe']->description)) {
                    $metaDescription = $page['cafe']->description;
                }
            } else {
                if (!empty($page['lead_text'])) {
                    $metaDescription = $page['lead_text'];
                }
                if (!empty($page['header_image'])) {
                    $ogImage = $page['header_image'];
                }
            }
            if ((empty($seoTag->meta_description) || is_null($seoTag->seo_tag_id)) && !empty($metaDescription)) {
                $seoTag->meta_description = str_limit(Html::strip($metaDescription), 157);
            }
            if (empty($seoTag->og_image) && !empty($ogImage)) {
                $seoTag->og_image = $ogImage;
                list($width, $height) = $this->getOgImageDimensions($ogImage);
                $seoTag->og_image_width = $width;
                $seoTag->og_image_height = $height;
            }
        });
    }

    protected function getOgImageDimensions($og_image)
    {
        $filePath = base_path($this->getImagePath($og_image));

        if (is_file($filePath)) {
            return getimagesize($filePath);
        }
        return false;
    }

    protected function getImagePath($image)
    {
        return MediaLibrary::url($image);
    }
}
