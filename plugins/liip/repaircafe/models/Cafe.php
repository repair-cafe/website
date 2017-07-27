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

    protected $dates = ['deleted_at'];

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
        ]
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'liip_repaircafe_cafes';
}