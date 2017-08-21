<?php namespace Liip\RepairCafe\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Model;
use RainLab\Translate\Models\Locale;

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
}
