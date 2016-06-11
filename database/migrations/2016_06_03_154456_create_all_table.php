<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        // creating roles table
        Schema::create('roles', function (Blueprint $table) {

            $table->increments('id');

            $table->string('role_name')->unique();

        });

        // creating admins table
        Schema::create('admins', function (Blueprint $table) {

            $table->increments('id');

            $table->string('email')->unique();

            $table->string('password');

            $table->boolean('status')->default(0);

            $table->rememberToken();

            $table->timestamps();

        });

        // creating role_admin pivot table
        Schema::create('role_admin', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('role_id')->unsigned();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('admin_id')->unsigned();

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');

        });

        // creating adproviders table
        Schema::create('adproviders', function (Blueprint $table) {

            $table->increments('id');

            $table->string('email')->unique();

            $table->string('password');

            $table->boolean('status')->default(0);          

            $table->rememberToken();

            $table->timestamps();

        });

        // creating memberships table
        Schema::create('memberships', function (Blueprint $table) {

            $table->increments('id');

            $table->string('plan_name');

            $table->string('adv_range');

            $table->string('amount');

            $table->timestamps();

        });

        // creating profiles table
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

        // creating categorys table
        Schema::create('categorys', function (Blueprint $table) {

            $table->increments('id');

            $table->string('category_name');

            $table->integer('profile_id')->unsigned();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade')->onUpdate('cascade');

            $table->boolean('status')->default(0);

            $table->timestamps();

        });

        // creating brands table
        Schema::create('brands', function (Blueprint $table) {

            $table->increments('id');

            $table->string('brand_name');

            $table->integer('profile_id')->unsigned();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade')->onUpdate('cascade');

            $table->boolean('status')->default(0);

            $table->timestamps();

        });

        // creating branchs table
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

        // creating products table
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

        // creating advertisements table
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

            $table->string('discount_type');

            $table->integer('percent_discount')->nullable();

            $table->integer('fixed_money_discount')->nullable();

            $table->integer('buy_product_no')->nullable();

            $table->integer('free_product_no')->nullable();

            $table->string('free_product_type')->nullable();

            $table->integer('actual_price');

            $table->integer('present_price');

            $table->date('expire_date');

            $table->boolean('status')->default(0);

            $table->timestamps();

        });

        // creating wishlists table
        Schema::create('wishlists', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('profile_id')->unsigned();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('advertisement_id')->unsigned();

            $table->foreign('advertisement_id')->references('id')->on('advertisements')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();

        });

        // creating watchlists table
        Schema::create('watchlists', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('profile_id')->unsigned();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('advertisement_id')->unsigned();

            $table->foreign('advertisement_id')->references('id')->on('advertisements')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();

        });

        // creating viewcounters table
        Schema::create('viewcounters', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('advertisement_id')->unsigned();

            $table->foreign('advertisement_id')->references('id')->on('advertisements')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();

        });

        // creating subscriptions table
        Schema::create('subscriptions', function (Blueprint $table) {

            $table->increments('id');

            $table->string('mobile_no')->unique();

            $table->integer('advertisement_id')->unsigned();

            $table->foreign('advertisement_id')->references('id')->on('advertisements')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        // creating archives table (for advertisements)
        Schema::create('archives', function (Blueprint $table) {

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

        Schema::dropIfExists('subscriptions');

        Schema::dropIfExists('archives');

    }
}
