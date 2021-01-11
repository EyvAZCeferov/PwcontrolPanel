<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Locations;
use App\Models\Posts;
use App\Models\Comments;
use App\Models\Ratings;

class Customers extends Model
{
    use SoftDeletes;

    protected $table = 'customers';
    protected $fillable = [
        'id',
        'logo',
        'az_name',
        'ru_name',
        'en_name',
        'az_description',
        'ru_description',
        'en_description',
        'slug'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function get_locations()
    {
        return $this->hasOne(Locations::class, 'customer_id', 'id');
    }

    public function get_posts()
    {
        return $this->hasOne(Posts::class, 'customer_id', 'id');
    }

    public function get_comments(){
        return $this->hasOne(Comments::class,'post_id','id');
    }

    public function get_rating(){
        return $this->hasMany(Ratings::class,'ratingable_id','id');
    }
}
