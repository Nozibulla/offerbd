<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';

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


    //function for creating the relationship among the tables

    public function profile()   
    {
        return $this->hasOne('App\Models\Profile');
    }

    //relationship with pivot table role_admin
    public function role()
    {
        return $this->belongsToMany('App\Models\Role','role_admin');
    }

    //checking whether the request sender has the right access
    public function hasRole($role_name)
    {

        foreach ($this->role as $role) {
            
            if ($role->role_name == $role_name) {
                
                return true;
            }

        }

        return false;

    }


}
