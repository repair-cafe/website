<?php namespace Liip\RepairCafe\Models;

use System\Models\File;
use October\Rain\Database\Model;

/**
 * Model
 */
class Contact extends Model
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

    public $attachOne = [
        'profile_picture' => [File::class]
    ];

//    public $belongsTo = [
//        'cafe' => [Cafe::class]
//    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'liip_repaircafe_contacts';
}
