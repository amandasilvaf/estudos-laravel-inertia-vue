<?php declare(strict_types=1);


namespace Modules\Extras\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Support\Helpers\LogsHelper;


class City extends Model
{
    use LogsActivity, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'cities';
    protected $with =  ['state'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'state_acronym',
        'name',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @var string[]
     */
    protected static $logAttributes = [
        'state_acronym',
        'name',
    ];

    public function state(){
        return $this->hasOne(State::class, 'uf', 'uf');
    }

    public function getLogNameToUse(string $eventName): string
    {
        return LogsHelper::getLogNameToUse(
            subjectClass: get_class($this),
            eventName: $eventName
        );
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return LogsHelper::getDescriptionForEvent(
            eventName: $eventName,
            subject: 'city',
            object: $this->name
        );
    }

    public function scopeSearch($query, $search = null)
    {
        if (!is_null($search)) {
            $query->where(
                "cities.name", "ilike", "%{$search}%"
            );
        }
    }
}
