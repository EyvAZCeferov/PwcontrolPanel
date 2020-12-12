<?php

namespace App\Models;

use App\Models\Customers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes;

    protected $table = 'posts';
    protected $fillable = [
        'id',
        'customer_id',
        'images',
        'clasor',
        'az_name',
        'ru_name',
        'en_name',
        'slug',
        'az_description',
        'ru_description',
        'en_description',
        'read_count',
        'startTime',
        'endTime',
        'price'
    ];
    protected $dates = ['startTime', 'endTime', 'created_at', 'updated_at', 'deleted_at'];


    public function getCustomer()
    {
        return $this->hasOne(Customers::class, 'id', 'customer_id');
    }

}
