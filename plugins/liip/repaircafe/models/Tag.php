<?php namespace Liip\RepairCafe\Models;

use Model;

/**
 * Model
 */
class Tag extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required|min:3'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'liip_repaircafe_tags';

    public $belongsToMany = [
        'event' => [Event::class, 'table' => 'liip_events_event_tag']
    ];
}
