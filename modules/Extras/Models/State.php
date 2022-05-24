<?php declare(strict_types=1);


namespace Modules\Extras\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Support\Helpers\LogsHelper;


class State extends Model
{
    use LogsActivity, SoftDeletes;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'states';

    /**
     * @var string
     */
    protected $primaryKey = 'acronym';

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'acronym',
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
        'acronym',
        'name',
    ];

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
            subject: 'state',
            object: $this->name
        );
    }

    public function scopeSearch($query, $search = null)
    {
        if (!is_null($search)) {
            $query->where(
                "states.acronym", "ilike", "%{$search}%"
            )->orWhere(
                "states.name", "ilike", "%{$search}%"
            );
        }
    }

}
