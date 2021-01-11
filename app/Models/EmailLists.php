<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLists extends Model
{
    protected $table='email_lists';
    protected $fillable=[
        'email',
        'ip_address',
    ];
}
