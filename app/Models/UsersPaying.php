<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BarcodeProducts;

class UsersPaying extends Model
{
    use SoftDeletes;

    protected $table='users_payings';
    protected $fillable=[
        'pay_id',
        'uid',
        'type',
        'payInfo',
    ];
    public function get_product_items(){
        return $this->hasMany(BarcodeProducts::class,'pay_id','pay_id');
    }
}
