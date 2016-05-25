<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [ 'product_name', 'category_id' ];

    // creating relationship with profile
    public function profile()
    {
    	return $this->belongsTo('App\Models\Profile');
    }

    // creating relationship category
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }    

    // creating relationship advertisement
    public function advertisement()
    {
    	return $this->hasMany('App\Models\Advertisement');
    }
}
