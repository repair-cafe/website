<?php namespace Liip\RepairCafe\Models;

use October\Rain\Database\Model;
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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'street', 'zip', 'city', 'slug', 'contacts', 'is_published'];

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
        'links' => [
            Link::class
        ],
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
