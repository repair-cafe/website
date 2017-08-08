<?php namespace Liip\RepairCafe\Models;

use October\Rain\Database\Model;
use RainLab\Translate\Behaviors\TranslatableModel;
use System\Models\File;

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

    public $implement = [TranslatableModel::class];

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

    public $translatable = [
        'title',
        'description',
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

    /**
     * @var string The database table used by the model.
     */
    public $table = 'liip_repaircafe_cafes';
}
