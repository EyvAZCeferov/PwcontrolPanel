<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class UserCards extends Model
{
    use SoftDeletes;

    protected $table='user_cards';
    protected $fillable=[
        'uid',
        'cardId',
        'cardInfos',
        'type',
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function getUser(){
        return $this->hasOne(User::class,'uid','uid');
    }
}
