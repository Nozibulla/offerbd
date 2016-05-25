<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Adprovider extends Authenticatable
{
    protected $table = 'adproviders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
