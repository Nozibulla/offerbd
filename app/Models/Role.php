<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

	protected $table = "roles";

	protected $fillable = ['role_name'];

    //relation with admins table

	public function admin()
	{
		return $this->belongsTo('App\Models\Admin','role_admin');
	}

}
