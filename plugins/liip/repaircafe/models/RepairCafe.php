<?php namespace Liip\RepairCafe\Models;

use Model;

/**
 * Model
 */
class RepairCafe extends Model
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
    ];

    public $belongsToMany = [
        'events' => [Event::class, 'table' => 'liip_repaircafe_events']
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'liip_repaircafe_repaircafes';
}