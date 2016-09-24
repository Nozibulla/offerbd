<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $table = "profiles";

	protected $fillable = [

	'first_name',
	'last_name',
	'mobile',
	'address',
	'image'

	];

	// creating the relationship with other models
	public function admin()
	{
		return $this->belongsTo('App\Models\Admin');
	}

	//finding the admin profile
	public function findAdmin($admin_id)
	{
		return $this->whereadmin_id($admin_id)->first();
	}

	// relationship with Brand
	public function brand()
	{
		return $this->hasOne('App\Models\Brand');
	}

	// relationship with branch
	public function branch()
	{
		return $this->hasOne('App\Models\Branch');
	}

	// relationship with category table
	public function category()
	{
		return $this->hasMany('App\Models\Category');
	}

	// relationship with products table
	public function product()
	{
		return $this->hasMany('App\Models\Product');
	}

	// relationship with advertisements table
	public function advertisement()
	{
		return $this->hasMany('App\Models\Advertisement');
	}

	// membership table
	public function membership()
	{
		return $this->belongsTo('App\Models\Membership');
	}

	// relationship with adprovider
	public function adprovider()
	{
		return $this->belongsTo('App\Models\Adprovider');
	}


}
