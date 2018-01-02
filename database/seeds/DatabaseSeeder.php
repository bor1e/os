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
      \App\Channel::create(['name'=>'kaschrut']);
      \App\Channel::create(['name'=>'halacha']);
      \App\Channel::create(['name'=>'schabbat']);
      \App\Channel::create(['name'=>'holidays']);
      \App\Channel::create(['name'=>'tanach']);
      \App\Channel::create(['name'=>'israel']);
      \App\Channel::create(['name'=>'lifestyle']);
      \App\Channel::create(['name'=>'philosophy']);
      \App\Channel::create(['name'=>'prayer']);


      \App\Role::create(['name'=>'manager']);
      \App\Role::create(['name'=>'teacher']);
      \App\Role::create(['name'=>'member']);
      \App\Role::create(['name'=>'pending']);
      \App\Role::create(['name'=>'declined']);
      \App\Role::create(['name'=>'email_confirmed']);

      \App\Permission::create(['name'=>'manageUsers']);
      \DB::table('permission_role')->insert([
        'permission_id' => \App\Permission::where('name','like','manageUsers')->first()->id,
        'role_id' => \App\Role::where('name','like','manager')->first()->id,
      ]);

      \App\Permission::create(['name'=>'addFeedback']);
      \DB::table('permission_role')->insert([
        'permission_id' => \App\Permission::where('name','like','addFeedback')->first()->id,
        'role_id' => \App\Role::where('name','like','manager')->first()->id,
      ]);
      \DB::table('permission_role')->insert([
        'permission_id' => \App\Permission::where('name','like','addFeedback')->first()->id,
        'role_id' => \App\Role::where('name','like','teacher')->first()->id,
      ]);
      \DB::table('permission_role')->insert([
        'permission_id' => \App\Permission::where('name','like','addFeedback')->first()->id,
        'role_id' => \App\Role::where('name','like','member')->first()->id,
      ]);

      \App\Permission::create(['name'=>'participateInCourse']);
      \DB::table('permission_role')->insert([
        'permission_id' => \App\Permission::where('name','like','participateInCourse')->first()->id,
        'role_id' => \App\Role::where('name','like','manager')->first()->id,
      ]);
      \DB::table('permission_role')->insert([
        'permission_id' => \App\Permission::where('name','like','participateInCourse')->first()->id,
        'role_id' => \App\Role::where('name','like','teacher')->first()->id,
      ]);
      \DB::table('permission_role')->insert([
        'permission_id' => \App\Permission::where('name','like','participateInCourse')->first()->id,
        'role_id' => \App\Role::where('name','like','member')->first()->id,
      ]);
    }
}
