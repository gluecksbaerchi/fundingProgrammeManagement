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

    public function getTargetWhatAttribute($value)
    {
        return json_decode($value);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
