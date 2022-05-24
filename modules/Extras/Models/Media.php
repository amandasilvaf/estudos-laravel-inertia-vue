<?php declare(strict_types=1);


namespace Modules\Extras\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Support\Helpers\LogsHelper;



class Media extends Model
{
    use LogsActivity, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'medias';


    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'path',
        'key',
        'url',
        'mimetype',
        'extension',
        'size',
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
        'name',
        'path',
        'key',
        'url',
        'mimetype',
        'extension',
        'size',
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
            subject: 'media',
            object: $this->name
        );
    }

    public function scopeSearch($query, $search = null)
    {
        if (!is_null($search)) {
            $query->where(
                "medias.name", "ilike", "%{$search}%"
            );
        }
    }

  
}
