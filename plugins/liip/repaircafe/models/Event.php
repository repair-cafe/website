<?php namespace Liip\RepairCafe\Models;

use October\Rain\Database\Model;
use Backend\Facades\BackendAuth;

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
        'start' => 'required',
        'end' => 'after:start',
        'cafe' => 'required',
        'latitude' => 'numeric',
        'longitude' => 'numeric',
    ];

    public $attributeNames = [
        'start' => 'liip.repaircafe::lang.event.start',
        'end' => 'liip.repaircafe::lang.event.end',
        'cafe' => 'liip.repaircafe::lang.relation.cafe',
        'latitude' => 'liip.repaircafe::lang.event.latitude',
        'longitude' => 'liip.repaircafe::lang.event.longitude',
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
        $access_token = Settings::get('mapbox_access_token', '');
        $api_url = Settings::get('static_map_api_url', '');
        if (!empty($this->latitude) && !empty($this->longitude) && !empty($access_token) && !empty($api_url)) {
            $api_url = str_replace("{ACCESS_TOKEN}", $access_token, $api_url);
            $api_url = str_replace("{LATITUDE}", $this->latitude, $api_url);
            $api_url = str_replace("{LONGITUDE}", $this->longitude, $api_url);
            $api_url = str_replace("{PIN_COLOR}", '4cabe5', $api_url);

            return $api_url;
        } else {
            return null;
        }
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

    public function scopeAuthorized($query)
    {
        $user = BackendAuth::getUser();

        if (!$user->isRepairCafeAdmin()) {
            $query->whereHas('cafe', function ($cafe_query) use ($user) {
                $cafe_query->whereHas('users', function ($user_query) use ($user) {
                    $user_query->where('user_id', $user->id);
                });
            });
        }

        return $query;
    }

    public function getCafeOptions()
    {
        $cafes = Cafe::query()->authorized()->get();
        $form = [];
        foreach ($cafes as $cafe) {
            $form[$cafe->id] = $cafe->title;
        }

        return $form;
    }
}
