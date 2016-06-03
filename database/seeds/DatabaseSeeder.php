<?php

use Illuminate\Database\Seeder;

// use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // roles table
      DB::table('roles')->insert(array(
       array('role_name'=>'owner'),
       array('role_name'=>'administrator')
       ));

      // memberships table
      DB::table('memberships')->insert(array(
       array('plan_name' => 'Free', 'adv_range' => 2, 'amount' => 0),
       array('plan_name' => 'Basic', 'adv_range' => 5, 'amount' => 1000),
       array('plan_name' => 'Silver', 'adv_range' => 10, 'amount' => 2000),
       array('plan_name' => 'Gold', 'adv_range' => 20, 'amount' => 3000),
       array('plan_name' => 'Platinum', 'adv_range' => 1000, 'amount' => 5000),
       ));

      // admins table
      DB::table('admins')->insert(array(
        array('email' => 'sakil.ruet09@gmail.com', 'password' => Hash::make('123456'), 'status' => 1),
        ));

      // role_admin table
      DB::table('role_admin')->insert(array(
        array('role_id' => 1, 'admin_id' => 1),
        array('role_id' => 2, 'admin_id' => 1)
        ));

      // profiles table
      DB::table('profiles')->insert(array(
        array('admin_id' => 1),
        ));
    }
  }
