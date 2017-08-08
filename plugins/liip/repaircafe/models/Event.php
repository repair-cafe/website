<?php namespace Liip\RepairCafe\Models;

use October\Rain\Database\Model;
use RainLab\Translate\Behaviors\TranslatableModel;

/**
 * Model
 */
class Event extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    // TODO: Workaround for an open OctoberCMS bug. See: https://github.com/rainlab/translate-plugin/issues/209
    use \Liip\RepairCafe\Traits\TranslatableModal;

    public $implement = [TranslatableModel::class];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
        'cafe_id',
        'is_published',
        'street',
        'zip',
        'city',
        'latitude',
        'longitude',
    ];

    public $translatable = [
        ['title', 'index' => true],
        ['description', 'index' => true],
    ];

    protected $dates = ['deleted_at'];

    /*
     * Validation
     */
    public $rules = [
        'end' => 'after:start',
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
