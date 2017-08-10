<?php namespace Liip\RepairCafe\Models;

use Exception;
use October\Rain\Database\Model;
use October\Rain\Support\Facades\Config;
use RainLab\Translate\Behaviors\TranslatableModel;
use GuzzleHttp\Client;

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
        ['title', 'index' => true],
        ['description', 'index' => true],
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

    private function getGeocodingApiEndpoint($street, $zip, $city)
    {
        $api_key = Config::get('liip.repaircafe::api_key');
        $api_url = Config::get('liip.repaircafe::geocoding_api_url');
        $country = Config::get('liip.repaircafe::country');

        $api_url = str_replace("{API_KEY}", $api_key, $api_url);
        $api_url = str_replace("{STREET}", $street, $api_url);
        $api_url = str_replace("{CITY}", $city, $api_url);
        $api_url = str_replace("{ZIP}", $zip, $api_url);
        $api_url = str_replace("{COUNTRY}", $country, $api_url);

        return $api_url;
    }

    public function getStaticMapURL()
    {
        if (!empty($this->latitude) && !empty($this->longitude)) {
            $api_key = Config::get('liip.repaircafe::api_key');
            $api_url = Config::get('liip.repaircafe::static_map_api_url');

            $api_url = str_replace("{API_KEY}", $api_key, $api_url);
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

            $external_map_url = str_replace("{LATITUDE}", $this->latitude, $external_map_url);
            $external_map_url = str_replace("{LONGITUDE}", $this->longitude, $external_map_url);

            return $external_map_url;
        } else {
            return null;
        }
    }

    public function beforeSave()
    {
        if ((empty($this->latitude) && empty($this->longitude)) &&
        ($this->street && $this->zip && $this->city)) {
            $api_url = $this->getGeocodingApiEndpoint(
                rawurlencode($this->street),
                rawurlencode($this->zip),
                rawurlencode($this->city)
            );

            $client = new Client();

            try {
                $response = $client->get($api_url);
                $json = $response->getBody();
                $data = json_decode($json);
            } catch (Exception $e) {
                // do nothing
            }

            if (!empty($data) && property_exists($data, 'results') && count($data->results) > 0) {
                $this->latitude = $data->results[0]->locations[0]->latLng->lat;
                $this->longitude = $data->results[0]->locations[0]->latLng->lng;
            }
        }
    }
}
