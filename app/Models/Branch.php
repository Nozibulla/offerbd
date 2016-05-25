<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = "branchs";

    protected $fillable = [ 'branch_name' ];

    // creating the relationship
    public function profile()
    {
    	return $this->belongsTo('App\Models\Profile');
    }
    // advertisement
    public function advertisement()
    {
    	return $this->hasMany('App\Models\Advertisement');
    }

}
