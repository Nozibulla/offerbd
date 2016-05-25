<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "brands";

    protected $fillable = [

    	'brand_name'
    ];

    // creating relationships with other models
    public function profile()
    {
    	return $this->belongsTo('App\Models\Profile');
    }

    // advertisement relation
    public function advertisement()
    {
    	return $this->hasMany('App\Models\Advertisement');
    }
}
