<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermofUse extends Model
{
    protected $table='termof_uses';
    protected $fillable=[
        'az_description',
        'ru_description',
        'en_description',
    ];
}
