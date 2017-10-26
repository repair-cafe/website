<?php namespace Liip\RepairCafe\Models;

use Carbon\Carbon;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Model;
use RainLab\Translate\Models\Locale;

/**
 * Model
 */
class News extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var array Generate slugs for these attributes.
     */
    protected $slugs = ['slug' => 'name'];

    public $implement = ['@Renatio.SeoManager.Behaviors.SeoModel'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'locale_id',
        'lead',
        'content',
        'publish_date',
    ];

    /*
     * Validation
     */
    public $rules = [
        'title' => 'required',
        'slug' => 'required',
        'locale' => 'required',
    ];

    public $attributeNames = [
        'title' => 'liip.repaircafe::lang.news.title',
        'slug' => 'liip.repaircafe::lang.news.slug',
        'locale' => 'liip.repaircafe::lang.relation.locale',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'liip_repaircafe_news';

    public $belongsTo = [
        'locale' => [Locale::class]
    ];

    /**
     * Only load news in current locale.
     */
    public function scopeCurrentLocale($query)
    {
        $currentLocale = Lang::getLocale();
        return $query->whereHas('locale', function ($query) use ($currentLocale) {
            $query->where('code', $currentLocale);
        });
    }

    /**
     * Only load published news.
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('publish_date')->where('publish_date', '<=', Carbon::now());
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

        if ($type === 'liip-repaircafe-all-news') {
            $menuTypeInfo = [
                'dynamicItems' => true,
            ];
        }

        if ($type === 'liip-repaircafe-news') {
            $menuTypeInfo = [
                'references' => self::listNewsMenuOptions(),
                'nesting' => false,
                'dynamicItems' => false,
            ];
        }

        if ($menuTypeInfo) {
            $theme = Theme::getActiveTheme();
            $pages = Page::listInTheme($theme, true);
            $cmsPages = [];
            foreach ($pages as $page) {
                if (!$page->hasComponent('newsDetail')) {
                    continue;
                }

                /*
                 * Component must use a routing parameter with the news slug
                 * eg: slug = "{{ :somevalue }}"
                 */
                $properties = $page->getComponentProperties('newsDetail');
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
        if ($item->type == 'liip-repaircafe-news') {
            if (!$item->reference || !$item->cmsPage) {
                return;
            }

            $news = self::find($item->reference);

            if (!$news) {
                return;
            }

            $pageUrl = self::getNewsPageUrl($item->cmsPage, $news, $theme);

            if (!$pageUrl) {
                return;
            }

            $pageUrl = URL::to($pageUrl);
            $menuItem = [];
            $menuItem['url'] = $pageUrl;
            $menuItem['isActive'] = $pageUrl == $url;
            $menuItem['mtime'] = $news->updated_at;
        } elseif ($item->type == 'liip-repaircafe-all-news') {
            $menuItem = [
                'items' => []
            ];
            $all_news = self::published()
                ->currentLocale()
                ->orderBy('publish_date', 'desc')
                ->get();
            foreach ($all_news as $news) {
                $newsItem = [
                    'title' => $news->title,
                    'url'   => self::getNewsPageUrl($item->cmsPage, $news, $theme),
                    'mtime' => $news->updated_at,
                ];
                $newsItem['isActive'] = $newsItem['url'] == $url;
                $menuItem['items'][] = $newsItem;
            }
        }
        return $menuItem;
    }

    /**
     * Returns URL of a news page.
     *
     * @param string $pageCode
     * @param News $news
     * @param \Cms\Classes\Theme $theme
     *
     * @return string
     */
    protected static function getNewsPageUrl($pageCode, $news, $theme)
    {
        $page = Page::loadCached($theme, $pageCode);
        if (!$page) {
            return;
        }
        $properties = $page->getComponentProperties('newsDetail');
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
        $url = Page::url($page->getBaseFileName(), [$paramName => $news->slug]);
        return $url;
    }

    /**
     * Returns a list of options for the Reference drop-down menu in the
     * menu item configuration form, when the news item type is selected.
     *
     * @return array
     */
    protected static function listNewsMenuOptions()
    {
        $all_news = self::published()
            ->orderBy('publish_date', 'desc')
            ->get();
        $news_menu_options = [];
        foreach ($all_news as $news) {
            $news_menu_options[$news->id] = $news->title;
        }
        return $news_menu_options;
    }
}
