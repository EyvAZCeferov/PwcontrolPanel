<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{

    protected $table = 'ratings';
    protected $fillable = [
        'rating',
        'ratingable_id',
        'author_type',
        'author_id',
        'tablename',
    ];
    protected $dates = ['created_at', 'updated_at'];

}
