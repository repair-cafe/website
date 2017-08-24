<?php namespace Liip\RepairCafe\Models;

use Backend\Facades\BackendAuth;
use October\Rain\Database\Model;
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

        if (!$user->isRepairCafeAdmin()) {
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
}
