<?php namespace Liip\RepairCafe\Models;

use Backend\Facades\BackendAuth;
use Backend\Models\User;
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

    public $belongsToMany = [
        'users' => [User::class, 'table' => 'liip_repaircafe_cafe_user']
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'liip_repaircafe_cafes';

    public function scopeByUser($query) {
        $user = BackendAuth::getUser();
        if(!$user->is_superuser) {
            $query::whereHas('users', function($users) use ($user) {
                $users->where('id', $user->id);
            });
        }
    }
}
