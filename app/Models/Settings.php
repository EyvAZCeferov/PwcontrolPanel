<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table='settings';
    protected $fillable=[
        'projectName',
        'description',
        'adminUrl',
        'logo',
        'phoneNumb',
        'email',
        'facebook_page',
        'instagram_page',
        'youtube_page',
        'twitter_page',
        'copyright',
        'coop_loc',
        'site_address'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
