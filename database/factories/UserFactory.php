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

$factory->define(App\Channel::class, function (Faker $faker) {

    return [
      'name' => $faker->word,
    ];
});

$factory->define(App\Course::class, function (Faker $faker) {

    return [
        'title' => $faker->text(60),
        'datetimetz' => $faker->dateTimeInInterval($startdate='now', $interval='+ 2 days'),#$faker->randomElement(array('11','12','13','14')).'.02.2018 15:45',
        'description' => $faker->text(160),
        'body' => $faker->text(500),
        'language' => $faker->randomElement(array('de','ru','en','he')),
        'slug' => $faker->slug,
        'dedication' => $faker->text(60),
        'g2m_id' => intval($faker->biasedNumberBetween(100000000, 999999999)),
        'cycle' => $faker->randomElement(array(0,1,2)),
        'channel_id' => function () {
          return factory('App\Channel')->create()->id;
        },
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
        'name' => $faker->userName,
    ];
});

$factory->define(App\Permission::class, function (Faker $faker) {
    return [
      'name' => $faker->randomElement(array('teacher','member','pending','declined')),
    ];
});


$factory->define(App\Teacher::class, function (Faker $faker) {

    return [
        'course_id' => function () {
          return factory('App\Course')->create()->id;
        },
        'user_id' => function () {
          return factory('App\User')->create()->id;
        },
    ];
});

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => $faker->randomElement(array('male', 'female')),
        'city' => $faker->city,
        'language' => $faker->randomElement(array('de','ru','en','he')),
        'facebook' => $faker->userName,
        'title' => $faker->title,
        'email_verification_token' => str_random(60),
        'jewish' => $faker->boolean(80),
        'birthday' => $faker->date,
        'phone' => $faker->phoneNumber,
        'notes' => $faker->sentences(5,true),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
#        'password_confirmation' => $password,
        'assignedBy' => $faker->randomElement(array('Chana','Elyahu','Yochewed','')),
        'remember_token' => str_random(10),
    ];
});
