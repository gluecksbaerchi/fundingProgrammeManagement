<?php
/**
 * Created by PhpStorm.
 * User: Carolin
 * Date: 12.11.2016
 * Time: 20:17
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundingProgramme extends Model
{
    const HISTORY_LIMIT = 10;

    protected $table = 'funding_programmes';

    protected $fillable = [
        'category_id',
        'name',
        'organisation',
        'target_what',
        'target_what_description',
        'target_who',
        'funding_sum',
        'application',
        'runtime_from',
        'runtime_to',
        'link',
        'contact_id'
    ];

    public function setTargetWhatAttribute($value)
    {
        $this->attributes['target_what'] = json_encode($value);
    }

    public function setChangesAttribute($value)
    {
        $this->attributes['changes'] = json_encode($value);
    }

    public function setRuntimeFromAttribute($value)
    {
        $this->attributes['runtime_from'] = empty($value) ? null : new \DateTime($value);
    }

    public function setRuntimeToAttribute($value)
    {
        $this->attributes['runtime_to'] = empty($value) ? null : new \DateTime($value);
    }

    public function setContactIdAttribute($value)
    {
        $this->attributes['contact_id'] = empty($value) ? null : $value;
    }

    public function getRuntimeFromAttribute($value)
    {
        return is_object($value) ? $value->format('Y-m-d H:i:s') : $value;
    }

    public function getRuntimeToAttribute($value)
    {
        return is_object($value) ? $value->format('Y-m-d H:i:s') : $value;
    }

    public function getTargetWhatAttribute($value)
    {
        return json_decode($value);
    }

    public function getChangesAttribute($value)
    {
        return json_decode($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function history()
    {
        return $this->hasMany(FundingProgramme::class, 'actual_id')
            ->limit(self::HISTORY_LIMIT)
            ->orderBy('updated_at', 'desc');
    }

    /**
     * @return bool
     */
    public function isOutdated()
    {
        if ($this->runtime_to != null) {
            $now = new \DateTime();
            $runtimeTo = new \DateTime($this->runtime_to);
            return $runtimeTo < $now;
        }
        return false;
    }

    public function compareWith(FundingProgramme $fundingProgramme)
    {
        $changes = [];
        foreach ($this->fillable as $attribute) {
            if ($fundingProgramme->$attribute != $this->$attribute) {
                $changes[$attribute] = $this->$attribute;
            }
        }
        return $changes;
    }

    /**
     * Get only the actual entries, not the history.
     *
     * @param $query
     * @return mixed
     */
    public function scopeActual($query)
    {
        return $query->where('actual_id', '=', null);
    }
}
