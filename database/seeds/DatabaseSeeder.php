<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(RolesTableSeeded::class);
        DB::table('roles')->insert(array(

           array('role_name'=>'owner'),
           array('role_name'=>'administrator')

           ));

        // membership table
        DB::table('memberships')->insert(array(

           array('plan_name' => 'Free', 'adv_range' => 2, 'amount' => 0),
           array('plan_name' => 'Basic', 'adv_range' => 5, 'amount' => 1000),
           array('plan_name' => 'Silver', 'adv_range' => 10, 'amount' => 2000),
           array('plan_name' => 'Gold', 'adv_range' => 20, 'amount' => 3000),
           array('plan_name' => 'Platinum', 'adv_range' => 1000, 'amount' => 5000),

           ));
    }
}
