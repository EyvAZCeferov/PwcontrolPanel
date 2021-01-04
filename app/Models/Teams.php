<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $table = 'teams';
    protected $fillable = [
        'image',
        'az_title',
        'ru_title',
        'en_title',
        'social',
        'az_description',
        'ru_description',
        'en_description',
        'order',
    ];
}
