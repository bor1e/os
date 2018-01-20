<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
      'title' => $faker->title,
      'type' => $faker->randomElement(array('teacher','user')),
      'phone' => $faker->phoneNumber,
      'city' => $faker->city,
      'country' => $faker->country,
      'timezone' => $faker->timezone,
      'language' => $faker->randomElement(array('de','ru','en','he')),
      'social_profile' => $faker->url,
      'jewish' => $faker->boolean(80),
      'birthday' =>date('Y-m-d H:i:s', strtotime('27.08.1990')),# $faker->date('d.m.Y'),
      'quotes' => $faker->sentences(4,true),
      'hobbies' => $faker->sentences(2,true),
      'message' => $faker->sentences(3,true),
      'notes' => $faker->sentences(5,true),
      'assignedBy' => $faker->randomElement(array('Chana','Elyahu','Yochewed','')),
    ];
});

$factory->define(App\Teacher::class, function (Faker $faker) {
    return [
      'first_name' => $faker->firstName,
      'last_name' => $faker->lastName,
      'email' => $faker->email,
      'gender' => $faker->randomElement(array('male', 'female')),
      'salary' => $faker->numberBetween(0,500),
      'slug' => $faker->slug,
      'profile_id' => function () {
          return factory('App\Profile')->create(['type'=>'teacher'])->id;
      },
    ];
});

$factory->define(App\Channel::class, function (Faker $faker) {
    return [
      'name' => $faker->word,
    ];
});

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'title' => $faker->text(60),
        'date' => today()->addDays(5), #$faker->randomElement(array('11','12','13','14')).'.02.2018 15:45',#  $faker->dateTimeInInterval($startdate='now', $interval='+ 2 days'),
        'time' => $faker->time(),
        'description' => $faker->text(160),
        'body' => $faker->text(500),
        'language' => $faker->randomElement(array('DE','RU','EN','HE')),
        'slug' => $faker->slug,
        'dedication' => $faker->text(60),
        'g2m_id' => 'https://global.gotomeeting.com/join/'.intval($faker->biasedNumberBetween(100000000, 999999999)),
        'intervall' => $faker->randomElement(array(0,1,2)),
        'meetings' => $faker->numberBetween(1,6),
        'level' => $faker->randomElement(array('advanced','expert','anyone')),
        'cost' => $faker->numberBetween(10,100),
        'teacher_id' => function () {
          return factory('App\Teacher')->create()->id;
        },
        'channel_id' => function () {
          return factory('App\Channel')->create()->id;
        },
        'status' =>  $faker->randomElement(array('published','pending','canceled')),
        'notes' => $faker->text(160),
      ];
});

$factory->define(App\CourseFeedback::class, function (Faker $faker) {
    return [
      'body' => $faker->sentences($faker->randomElement(array(1,2,3,4)), true),
      'course_id' => function () {
        return factory('App\Course')->create()->id;
      },
      'user_id' => function () {
        return factory('App\User')->create()->id;
      },
    ];
});

$factory->define(App\Participant::class, function (Faker $faker) {
    return [
        'course_id' => function () {
          return factory('App\Course')->create()->id;
        },
        'user_id' => function () {
          return factory('App\User')->create()->id;
        },
    ];
});

$factory->define(App\Role::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(array('teacher','member','pending','declined')),
    ];
});

$factory->define(App\Permission::class, function (Faker $faker) {
    return [
      'name' => $faker->randomElement(array('member','pending','declined')),
    ];
});

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => $faker->randomElement(array('male', 'female')),
        'email' => $faker->unique()->safeEmail,
        'email_verification_token' => str_random(60),
          'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'profile_id' => function () {
            return factory('App\Profile')->create(['type'=>'user'])->id;
        },
    ];
});
