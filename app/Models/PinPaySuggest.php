<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PinPaySuggest extends Model
{
    protected $table='pin_pay_suggests';
    protected $fillable=[
        'pin_pay_id',
        'suggest_names',
        'suggest_descriptions',
        'suggest_location',
        'suggest_social',
        'pin',
    ];
}
