<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends AuthUser
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $guarded = [
        
    ];

    protected $hidden = [
        'password'
    ];

    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function tf()
    {
        return 123;
    }

}
