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
      \App\Role::create(['name'=>'manager']);
      \App\Role::create(['name'=>'teacher']);
      \App\Role::create(['name'=>'member']);
      \App\Role::create(['name'=>'pending']);
      \App\Role::create(['name'=>'declined']);

      \App\Permission::create(['name'=>'manageUsers']);

    }
}
