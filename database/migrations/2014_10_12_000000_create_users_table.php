<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::create('roles', function (Blueprint $table) {

			$table->increments('id');

			$table->string('role_name')->unique();

		});

		Schema::create('admins', function (Blueprint $table) {

			$table->increments('id');

			$table->string('email')->unique();

			$table->string('password');

			$table->boolean('status')->default(0);

			$table->rememberToken();

			$table->timestamps();

		});

		Schema::create('role_admin', function (Blueprint $table) {

			$table->increments('id');

			$table->integer('role_id')->unsigned();

			$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');

			$table->integer('admin_id')->unsigned();

			$table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');

		});

		Schema::create('adproviders', function (Blueprint $table) {

			$table->increments('id');

			$table->string('email')->unique();

			$table->string('password');

			$table->rememberToken();

			$table->timestamps();

		});

		Schema::create('memberships', function (Blueprint $table) {

			$table->increments('id');

			$table->string('plan_name');

			$table->string('adv_range');

			$table->string('amount');

			$table->timestamps();

		});

		Schema::create('profiles', function (Blueprint $table) {

			$table->increments('id');

			$table->string('first_name');

			$table->string('last_name');

			$table->string('mobile');

			$table->string('address');

			$table->string('image');

			$table->integer('admin_id')->unsigned()->nullable();

			$table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');

			$table->integer('adprovider_id')->unsigned()->nullable();

			$table->foreign('adprovider_id')->references('id')->on('adproviders')->onDelete('cascade')->onUpdate('cascade');

			$table->integer('membership_id')->unsigned()->nullable();

			$table->foreign('membership_id')->references('id')->on('memberships')->onDelete('cascade')->onUpdate('cascade');

			$table->timestamps();
			
		});

		Schema::create('categorys', function (Blueprint $table) {

			$table->increments('id');

			$table->string('category_name');

			$table->integer('profile_id')->unsigned();

			$table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade')->onUpdate('cascade');

			$table->boolean('status')->default(0);

			$table->timestamps();

		});

		Schema::create('brands', function (Blueprint $table) {

			$table->increments('id');

			$table->string('brand_name');

			$table->integer('profile_id')->unsigned();

			$table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade')->onUpdate('cascade');

			$table->boolean('status')->default(0);

			$table->timestamps();

		});

		Schema::create('branchs', function (Blueprint $table) {

			$table->increments('id');

			$table->string('branch_name');

			$table->integer('brand_id')->unsigned();

			$table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');

			$table->integer('profile_id')->unsigned();

			$table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade')->onUpdate('cascade');

			$table->boolean('status')->default(0);

			$table->timestamps();

		});

		Schema::create('products', function (Blueprint $table) {

			$table->increments('id');

			$table->string('product_name');

			$table->integer('category_id')->unsigned();

			$table->foreign('category_id')->references('id')->on('categorys')->onDelete('cascade')->onUpdate('cascade');

			$table->integer('profile_id')->unsigned();

			$table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade')->onUpdate('cascade');

			$table->boolean('status')->default(0);

			$table->timestamps();

		});

		Schema::create('advertisements', function (Blueprint $table) {

			$table->increments('id');

			$table->string('ad_image');

			$table->integer('brand_id')->unsigned();

			$table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');

			$table->integer('branch_id')->unsigned();

			$table->foreign('branch_id')->references('id')->on('branchs')->onDelete('cascade')->onUpdate('cascade');

			$table->integer('product_id')->unsigned();

			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

			$table->integer('profile_id')->unsigned();

			$table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade')->onUpdate('cascade');

			$table->string('sponsored_amount')->default(0);

			$table->string('discount');

			$table->string('actual_price');

			$table->string('present_price');

			$table->date('expire_date');

			$table->boolean('status')->default(0);

			$table->timestamps();

		});

		Schema::create('wishlists', function (Blueprint $table) {

			$table->increments('id');

			$table->integer('profile_id')->unsigned();

			$table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade')->onUpdate('cascade');

			$table->integer('advertisement_id')->unsigned();

			$table->foreign('advertisement_id')->references('id')->on('advertisements')->onDelete('cascade')->onUpdate('cascade');

			$table->timestamps();

		});

		Schema::create('watchlists', function (Blueprint $table) {

			$table->increments('id');

			$table->integer('profile_id')->unsigned();

			$table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade')->onUpdate('cascade');

			$table->integer('advertisement_id')->unsigned();

			$table->foreign('advertisement_id')->references('id')->on('advertisements')->onDelete('cascade')->onUpdate('cascade');

			$table->timestamps();

		});

		Schema::create('viewcounters', function (Blueprint $table) {

			$table->increments('id');

			$table->integer('advertisement_id')->unsigned();

			$table->foreign('advertisement_id')->references('id')->on('advertisements')->onDelete('cascade')->onUpdate('cascade');

			$table->timestamps();

		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

		Schema::dropIfExists('roles');

		Schema::dropIfExists('admins');

		Schema::dropIfExists('role_admin');

		Schema::dropIfExists('adproviders');

		Schema::dropIfExists('profiles');

		Schema::dropIfExists('memberships');

		Schema::dropIfExists('categorys');

		Schema::dropIfExists('brands');

		Schema::dropIfExists('branchs');

		Schema::dropIfExists('products');

		Schema::dropIfExists('advertisements');

		Schema::dropIfExists('wishlists');

		Schema::dropIfExists('watchlists');

		Schema::dropIfExists('viewcounters');

	}
}
