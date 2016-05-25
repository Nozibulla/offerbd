<?php

use Illuminate\Database\Seeder;

class RolesTableSeeded extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(

             array('role_name'=>'owner'),
             array('role_name'=>'administrator')

          ));
    }
}
