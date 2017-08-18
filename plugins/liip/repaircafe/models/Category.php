<?php namespace Liip\RepairCafe\Models;

use October\Rain\Database\Model;
use RainLab\Translate\Behaviors\TranslatableModel;

/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var array Generate slugs for these attributes.
     */
    protected $slugs = ['slug' => 'name'];

    public $implement = [TranslatableModel::class];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public $translatable = [
        'name',
        'description',
    ];

    /*
     * Validation
     */
    public $rules = [
    ];

    public $hasMany = [
        'events' => [Event::class, 'table' => 'liip_repaircafe_event_category']
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'liip_repaircafe_categories';
}
