<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $table = "advertisements";

    protected $fillable = [ 'ad_image', 'brand_id', 'branch_id', 'product_id', 'profile_id', 'discount', 'actual_price', 'present_price', 'expire_date'];

    // relationship
    public function profile()
    {
    	return $this->belongsTo('App\Models\Profile');
    }
    // brand relation
    public function brand()
    {
    	return $this->belongsTo('App\Models\Brand');
    }
    // branch
    public function branch()
    {
    	return $this->belongsTo('App\Models\Branch');
    }
    // product
    public function product()
    {
    	return $this->belongsTo('App\Models\Product');
    }
}
