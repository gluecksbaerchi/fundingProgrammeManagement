<?php
/**
 * Created by PhpStorm.
 * User: Carolin
 * Date: 13.11.2016
 * Time: 16:12
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'street',
        'street_nr',
        'zip_code',
        'city',
        'tel',
        'fax',
        'email',
        'internet'
    ];
}
