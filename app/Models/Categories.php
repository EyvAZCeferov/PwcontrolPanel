<?php

namespace App\Models;

use App\Models\Locations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Comments;
use App\Models\Ratings;

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
        return $this->hasOne('\App\Models\Categories', 'id', 'top_category');
    }

    public function get_comments(){
        return $this->hasOne(Comments::where('table','customers'),'post_id','id');
    }

    public function get_rating(){
        return $this->hasMany(Ratings::where('tablename','customers'),'ratingable_id','id');
    }

}
