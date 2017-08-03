<?php namespace Liip\RepairCafe\Models;

use October\Rain\Database\Model;

/**
 * Model
 */
class LinkType extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'class_name'];

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

    /**
     * @var string The database table used by the model.
     */
    public $table = 'liip_repaircafe_linktypes';
}
