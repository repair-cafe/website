<?php namespace Liip\RepairCafe\Models;

use Model;
use System\Models\File;
use RainLab\Translate\Models\Locale as LocaleModel;

/**
 * Model
 */
class News extends Model
{
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var array Generate slugs for these attributes.
     */
    protected $slugs = ['slug' => 'name'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'liip_repaircafe_news';

    public function getLocaleOptions($value, $formData)
    {
        return LocaleModel::listEnabled();
    }
}
