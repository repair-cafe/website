<?php namespace Liip\RepairCafe\Models;

use October\Rain\Database\Model;

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
    protected $fillable = ['title', 'description', 'start', 'end', 'cafe_id', 'is_published'];

    protected $dates = ['deleted_at'];

    /*
     * Validation
     */
    public $rules = [
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
}
