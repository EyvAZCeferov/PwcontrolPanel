<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Customers;

class Locations extends Model
{
    use SoftDeletes;

    protected $table = 'locations';
    protected $fillable = [
        'id',
        'images',
        'customer_id',
        'clasor',
        'az_description',
        'ru_description',
        'en_description',
        'az_location',
        'ru_location',
        'en_location',
        'geometry'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function get_customer()
    {
        return $this->hasOne(Customers::class, 'id', 'customer_id');
    }
}
