<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table='faqs';
    protected $fillable=[
        'image',
        'az_title',
        'ru_title',
        'en_title',
        'az_description',
        'ru_description',
        'en_description',
        'order',
    ];
}
