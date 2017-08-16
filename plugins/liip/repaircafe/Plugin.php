<?php namespace Liip\RepairCafe;

use Backend\Models\User as BackendUserModel;
use Backend\Controllers\Users as BackendUsersController;
use Liip\RepairCafe\Console\Seed;
use Liip\RepairCafe\Models\Cafe;
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

    public function boot()
    {
        BackendUserModel::extend(function ($model) {
            $model->belongsToMany['cafes'] = [
                Cafe::class,
                'table' => 'liip_repaircafe_cafe_user'
            ];

            $model->addDynamicMethod('hasRole', function($role) use ($model) {
                return $model->groups()->whereName($role)->exists();
            });

            $model->addDynamicMethod('isAdmin', function() use ($model) {
                return $model->hasRole('owners');
            });
        });

        BackendUsersController::extendFormFields(function ($form, $model, $context) {

            if (!$model instanceof BackendUserModel) {
                return;
            }

            $form->addTabFields([
                'cafes' => [
                    'label'   => 'Cafe',
                    'comment' => 'Associate this user with a cafe.',
                    'type' => 'relation',
                    'list' => '$/liip/repaircafe/models/cafe/columns.yaml',
                    'nameFrom' => 'title',
                    'tab' => 'repaircafes'
                ],
            ]);
        });
    }
}
