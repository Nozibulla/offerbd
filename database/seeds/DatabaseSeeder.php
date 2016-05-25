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
    }
}
