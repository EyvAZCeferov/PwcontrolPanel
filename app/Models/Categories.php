<?php

namespace App\Models;

use App\Models\Locations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = [
        'id',
        'top_category',
        'icon',
        'clasor',
        'az_name',
        'ru_name',
        'en_name',
        'slug',
        'az_description',
        'ru_description',
        'en_description'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function topCategory()
    {
        return $this->hasOne('\App\Models\Categories', 'top_category', 'id');
    }

    public function getPost()
    {
        return $this->hasOne(Locations::class, 'customer_id', 'id');
    }

}
