<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthUser;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends AuthUser
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [
        
    ];

    protected $hidden = [
        'password'
    ];
}
