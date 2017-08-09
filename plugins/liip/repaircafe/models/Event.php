<?php namespace Liip\RepairCafe\Models;

use October\Rain\Database\Model;
use RainLab\Translate\Behaviors\TranslatableModel;

/**
 * Model
 */
class Event extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    public $implement = [TranslatableModel::class];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
        'cafe_id',
        'is_published',
        'street',
        'zip',
        'city',
        'latitude',
        'longitude',
    ];

    public $translatable = [
        'title',
        'description',
    ];

    protected $dates = ['deleted_at'];

    /*
     * Validation
     */
    public $rules = [
        'end' => 'after:start',
    ];

    public $belongsToMany = [
        'categories' => [Category::class, 'table' => 'liip_repaircafe_event_category']
    ];

    public $belongsTo = [
        'cafe' => [Cafe::class]
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'liip_repaircafe_events';
    public function getStaticMapURL() {

        $api_key = Config::get('liip.repaircafe::api_key');
        $api_url = Config::get('liip.repaircafe::static_map_api_url');

        $api_url = str_replace("{API_KEY}", $api_key, $api_url);
        $api_url = str_replace("{LATITUDE}", $this->latitude, $api_url);
        $api_url = str_replace("{LONGITUDE}", $this->longitude, $api_url);

        return $api_url;
    }

}
