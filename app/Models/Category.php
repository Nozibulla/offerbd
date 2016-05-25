<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categorys";

    protected $fillable = [ "category_name" ];

    // relationship with profile page
    public function profile()
    {
    	return $this->belongsTo('App\Models\Profile');
    }
    // product relation
    public function product()
    {
    	return $this->hasMany('App\Models\Product');
    }
}
