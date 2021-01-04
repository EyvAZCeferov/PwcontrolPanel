<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    protected $table = 'why_choose_us';
    protected $fillable = [
        'id',
        'az_title',
        'ru_title',
        'en_title',
        'cover_image',
    ];

    public function getItems()
    {
        return $this->hasMany(WhyChooseUsItems::class, 'top_id', 'id');
    }
}
