<?php namespace Liip\RepairCafe\Models;

use Exception;
use Illuminate\Support\Facades\Lang;
use October\Rain\Database\Model;
use October\Rain\Support\Facades\Config;
use October\Rain\Support\Facades\Flash;
use GuzzleHttp\Client as GuzzleClient;

/**
 * Model
 */
class Event extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

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

    protected $dates = ['deleted_at'];

    /*
     * Validation
     */
    public $rules = [
        'end' => 'after:start',
    ];

    public $belongsToMany = [
        'categories' => [
            Category::class,
            'table' => 'liip_repaircafe_event_category',
            'order' => 'name asc',
        ],
    ];

    public $belongsTo = [
        'cafe' => [Cafe::class]
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'liip_repaircafe_events';

    public function getStaticMapURL()
    {
        if (!empty($this->latitude) && !empty($this->longitude)) {
            $access_token = Config::get('liip.repaircafe::mapbox_access_token');
            $api_url = Config::get('liip.repaircafe::static_map_api_url');

            $api_url = str_replace("{ACCESS_TOKEN}", $access_token, $api_url);
            $api_url = str_replace("{LATITUDE}", $this->latitude, $api_url);
            $api_url = str_replace("{LONGITUDE}", $this->longitude, $api_url);

            return $api_url;
        } else {
            return null;
        }
    }

    public function getExternalMapURL()
    {
        if (!empty($this->latitude) && !empty($this->longitude)) {
            $external_map_url = Config::get('liip.repaircafe::external_map_url');

            $external_map_url = str_replace("{QUERY}", rawurlencode($this->getFormattedAddress()), $external_map_url);

            return $external_map_url;
        } else {
            return null;
        }
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

    public function getFormattedDate()
    {
        $formattedDate = '';
        $startDate = new \DateTime($this->start);
        if (!empty($this->end)) {
            $endDate = new \DateTime($this->end);
            if ($startDate->format('dmY') === $endDate->format('dmY')) {
                $formattedDate .= strftime('%d.%m.%Y', $startDate->getTimestamp());
            } else {
                $formattedDate .= strftime('%d.%m.%Y', $startDate->getTimestamp());
                $formattedDate .= ' - ' . strftime('%d.%m.%Y', $endDate->getTimestamp());
            }
            $formattedDate .= ' ' . strftime('%H:%M', $startDate->getTimestamp());
            $formattedDate .= ' - ' . strftime('%H:%M', $endDate->getTimestamp());
        } else {
            $formattedDate .= strftime('%d.%m.%Y %H:%M', $startDate->getTimestamp());
        }

        return $formattedDate;
    }

    public function getTitle($condensed = false)
    {
        if ($condensed) {
            return $this->title ? $this->title : $this->cafe->title;
        } else {
            return $this->cafe->title . ( $this->title ? ': ' . $this->title : '' );
        }
    }
}
