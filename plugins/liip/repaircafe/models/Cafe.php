<?php namespace Liip\RepairCafe\Models;

use Backend\Facades\BackendAuth;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use Illuminate\Support\Facades\URL;
use Model;
use System\Models\File;
use Backend\Models\User as BackendUserModel;

/**
 * Model
 */
class Cafe extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var array Generate slugs for these attributes.
     */
    protected $slugs = ['slug' => 'name'];

    protected $dates = ['deleted_at'];

    public $implement = ['@Renatio.SeoManager.Behaviors.SeoModel'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'street',
        'zip',
        'city',
        'slug',
        'contacts',
        'is_published',
        'website_link',
        'contact_link',
        'facebook',
        'twitter',
        'instagram',
    ];

    /*
     * Validation
     */
    public $rules = [
        'title' => 'required',
        'slug' => 'required',
    ];

    public $attributeNames = [
        'title' => 'liip.repaircafe::lang.cafe.title',
        'slug' => 'liip.repaircafe::lang.cafe.slug',
    ];

    public $attachOne = [
        'logo' => [File::class],
        'image' => [File::class]
    ];

    public $hasMany = [
        'contacts' => [
            Contact::class
        ],
        'events' => [
            Event::class
        ]
    ];

    public $belongsToMany = [
        'users' => [
            BackendUserModel::class,
            'table' => 'liip_repaircafe_cafe_user'
        ]
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'liip_repaircafe_cafes';

    /**
     * Only load published cafes.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeAuthorized($query)
    {
        $user = BackendAuth::getUser();

        if ($user->hasRole('repaircafeOrganisator')) {
            $query->whereHas('users', function ($user_query) use ($user) {
                $user_query->where('user_id', $user->id);
            });
        }

        return $query;
    }

    public function getFormattedAddress()
    {
        $formattedAddress = '';

        if (!empty($this->street) || !empty($this->city)) {
            $formattedAddress = ($this->street ? $this->street : '');
            if ($this->city && $this->street) {
                $formattedAddress .= ', ';
            }
            if ($this->city) {
                $formattedAddress .= ($this->zip ? $this->zip . ' ' : '') . $this->city;
            }
        }
        return $formattedAddress;
    }

    public function getExternalMapURL()
    {
        $external_map_url = '';

        if (!empty($this->getFormattedAddress())) {
            $external_map_url = Settings::get('external_map_url', '');

            $external_map_url = str_replace("{ADDRESS}", rawurlencode($this->getFormattedAddress()), $external_map_url);
        }
        return $external_map_url;
    }

    /**
     * Handler for the pages.menuitem.getTypeInfo event.
     * Returns a menu item type information. The type information is returned as array
     * with the following elements:
     * - references - a list of the item type reference options. The options are returned in the
     *   ["key"] => "title" format for options that don't have sub-options, and in the format
     *   ["key"] => ["title"=>"Option title", "items"=>[...]] for options that have sub-options. Optional,
     *   required only if the menu item type requires references.
     * - nesting - Boolean value indicating whether the item type supports nested items. Optional,
     *   false if omitted.
     * - dynamicItems - Boolean value indicating whether the item type could generate new menu items.
     *   Optional, false if omitted.
     * - cmsPages - a list of CMS pages (objects of the Cms\Classes\Page class), if the item type requires a CMS page reference to
     *   resolve the item URL.
     *
     * @param string $type Specifies the menu item type
     * @return array Returns an array
     */
    public static function getMenuTypeInfo($type)
    {
        $menuTypeInfo = [];

        if ($type === 'liip-repaircafe-all-cafes') {
            $menuTypeInfo = [
                'dynamicItems' => true,
            ];
        }

        if ($type === 'liip-repaircafe-cafe') {
            $menuTypeInfo = [
                'references' => self::listCafeMenuOptions(),
                'nesting' => false,
                'dynamicItems' => false,
            ];
        }

        if ($menuTypeInfo) {
            $theme = Theme::getActiveTheme();
            $pages = Page::listInTheme($theme, true);
            $cmsPages = [];
            foreach ($pages as $page) {
                if (!$page->hasComponent('cafeDetail')) {
                    continue;
                }

                /*
                 * Component must use a routing parameter with the cafe slug
                 * eg: slug = "{{ :somevalue }}"
                 */
                $properties = $page->getComponentProperties('cafeDetail');
                if (!preg_match('/{{\s*:/', $properties['slug'])) {
                    continue;
                }

                $cmsPages[] = $page;
            }
            $menuTypeInfo['cmsPages'] = $cmsPages;
        }

        return $menuTypeInfo;
    }

    /**
     * Handler for the pages.menuitem.resolveItem event.
     * Returns information about a menu item. The result is an array
     * with the following keys:
     * - url - the menu item URL. Not required for menu item types that return all available records.
     *   The URL should be returned relative to the website root and include the subdirectory, if any.
     *   Use the Url::to() helper to generate the URLs.
     * - isActive - determines whether the menu item is active. Not required for menu item types that
     *   return all available records.
     * - items - an array of arrays with the same keys (url, isActive, items) + the title key.
     *   The items array should be added only if the $item's $nesting property value is TRUE.
     *
     * @param \RainLab\Pages\Classes\MenuItem $item Specifies the menu item.
     * @param \Cms\Classes\Theme $theme Specifies the current theme.
     * @param string $url Specifies the current page URL, normalized, in lower case
     * The URL is specified relative to the website root, it includes the subdirectory name, if any.
     *
     * @return mixed Returns an array. Returns null if the item cannot be resolved.
     */
    public static function resolveMenuItem($item, $url, $theme)
    {
        $menuItem = null;
        if ($item->type == 'liip-repaircafe-cafe') {
            if (!$item->reference || !$item->cmsPage) {
                return;
            }

            $cafe = self::find($item->reference);

            if (!$cafe) {
                return;
            }

            $pageUrl = self::getCafePageUrl($item->cmsPage, $cafe, $theme);

            if (!$pageUrl) {
                return;
            }

            $pageUrl = URL::to($pageUrl);
            $menuItem = [];
            $menuItem['url'] = $pageUrl;
            $menuItem['isActive'] = $pageUrl == $url;
            $menuItem['mtime'] = $cafe->updated_at;
        } elseif ($item->type == 'liip-repaircafe-all-cafes') {
            $menuItem = [
                'items' => []
            ];
            $cafes = self::published()
                ->orderBy('title', 'asc')
                ->get();
            foreach ($cafes as $cafe) {
                $cafeItem = [
                    'title' => $cafe->title,
                    'url'   => self::getCafePageUrl($item->cmsPage, $cafe, $theme),
                    'mtime' => $cafe->updated_at,
                ];
                $cafeItem['isActive'] = $cafeItem['url'] == $url;
                $menuItem['items'][] = $cafeItem;
            }
        }
        return $menuItem;
    }

    /**
     * Returns URL of a cafe page.
     *
     * @param string $pageCode
     * @param Cafe $cafe
     * @param \Cms\Classes\Theme $theme
     *
     * @return string
     */
    protected static function getCafePageUrl($pageCode, $cafe, $theme)
    {
        $page = Page::loadCached($theme, $pageCode);
        if (!$page) {
            return;
        }
        $properties = $page->getComponentProperties('cafeDetail');
        if (!isset($properties['slug'])) {
            return;
        }
        /*
         * Extract the routing parameter name
         * eg: {{ :someRouteParam }}
         */
        if (!preg_match('/^\{\{([^\}]+)\}\}$/', $properties['slug'], $matches)) {
            return;
        }
        $paramName = substr(trim($matches[1]), 1);
        $url = Page::url($page->getBaseFileName(), [$paramName => $cafe->slug]);
        return $url;
    }

    /**
     * Returns a list of options for the Reference drop-down menu in the
     * menu item configuration form, when the cafe item type is selected.
     *
     * @return array
     */
    protected static function listCafeMenuOptions()
    {
        $cafes = self::published()
            ->orderBy('title', 'asc')
            ->get();
        $cafe_menu_options = [];
        foreach ($cafes as $cafe) {
            $cafe_menu_options[$cafe->id] = $cafe->title;
        }
        return $cafe_menu_options;
    }
}
