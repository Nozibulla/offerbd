<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table = "memberships";

    protected $fillable = [ 'plan_name', 'adv_range', 'amount' ];

    // relationships

    // relationship with profile table
    public function profile()
    {
    	return $this->hasMany('App\Models\Profile');
    }
}
