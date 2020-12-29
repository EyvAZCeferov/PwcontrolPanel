<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table='abouts';
    protected $fillable=[
        'images',
        'az_title',
        'ru_title',
        'en_title',
        'az_motive',
        'ru_motive',
        'en_motive',
        'az_description',
        'ru_description',
        'en_description',
    ];
}
