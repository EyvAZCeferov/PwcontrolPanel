<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUsItems extends Model
{
    protected $table='why_choose_us_items';
    protected $fillable=[
        'icon',
        'top_id',
        'az_title',
        'ru_title',
        'en_title',
        'az_description',
        'ru_description',
        'en_description',
        'order',
    ];
}
