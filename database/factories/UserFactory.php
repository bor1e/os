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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => $faker->randomElement(array('male', 'female')),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'approved' => $faker->boolean(60),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Course::class, function (Faker $faker) {

    return [
        'title' => $faker->text(60),
        'datetimetz' => $faker->dateTime('now','UTC'),
        'description' => $faker->text(160),
        'body' => $faker->text(500),
        'slug' => $faker->slug,
        'g2m_id' => $faker->biasedNumberBetween(100000000, 999999999),
        'cycle' => $faker->randomElement(array(0,1,2)),
      ];
});

$factory->define(App\Teacher::class, function (Faker $faker) {

    return [
        'city' => $faker->city,
        'course_id' => function () {
          return factory('App\Course')->create()->id;
        },
        'facebook' => $faker->userName,
        'title' => $faker->title,
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
