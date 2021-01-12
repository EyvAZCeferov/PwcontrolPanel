<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UsersPaying;

class BarcodeProducts extends Model
{
    protected $table='barcode_products';
    protected $fillable=[
        'pay_id',
        'element_id',
        'uid',
        'product',
        'price',
        'qyt',
    ];
    public function get_pay_info(){
        return $this->hasMany(UsersPaying::class,'pay_id','pay_id');
    }
}
