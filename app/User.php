<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserCards;
use App\Models\UsersPaying;
use Laravel\Passport\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens,Notifiable, Softdeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phoneNumber',
        'profilePhoto',
        'name',
        'uid',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'phoneNumber_verified_at'=>'datetime',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function get_cards(){
        return $this->hasMany(UserCards::class,'uid','uid');
    }

    public function get_payings(){
        return $this->hasOne(UsersPaying::class,'uid','uid');
    }

    public function pininfo(){
        return $this->hasOne(UserCards::class,'uid','uid');
    }



}
