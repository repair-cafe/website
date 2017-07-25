<?php namespace Liip\RepairCafe\Models;

use Backend\Facades\BackendAuth;
use Backend\Models\User;
use October\Rain\Database\Model;

/**
 * Model
 */
class Event extends Model
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
        'title' => 'required',
        'description' => 'required',
        'start' => 'required|date',
        'end' => 'required|date',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'liip_repaircafe_events';

    public $belongsToMany = [
        'tags' => [Tag::class, 'table' => 'liip_repaircafe_event_tag']
    ];
    public $belongsTo = [
        'repaircafe' => [RepairCafe::class, 'table' => 'liip_repaircafe_repaircafe_event'],
        'user' => [User::class]
    ];

    public function scopePublished($query)
    {
        $query->where('is_published', true);
    }

    public function scopeByUser($query)
    {
        $user = BackendAuth::getUser();
        if (!$user->is_superuser) {
            $query->where('user_id', $user->id);
        }
    }

    public function beforeSave()
    {
        $this->user = BackendAuth::getUser();
    }
}
