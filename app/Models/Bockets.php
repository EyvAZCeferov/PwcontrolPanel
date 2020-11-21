<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bockets extends Model
{
    use SoftDeletes;

    protected $table = 'bockets';
    protected $fillable = [
        'id',
        'category',
        'customer_id',
        'icon',
        'clasor',
        'az_name',
        'ru_name',
        'en_name',
        'slug',
        'az_description',
        'ru_description',
        'en_description',
        'shopping_count',
        'price'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function getCat()
    {
        return $this->hasOne(Categories::class, 'id', 'category');
    }

    public function getCustomer()
    {
        return $this->hasOne(Customers::class, 'id', 'customer_id');
    }
}
