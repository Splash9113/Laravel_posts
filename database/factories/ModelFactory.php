<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function () {
    static $password = '123456';

    return [
        'name' => 'Admin',
        'email' => 'admin@admin.com',
        'password' => bcrypt($password),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->company,
        'body' => $faker->text,
        'active' => $faker->boolean,
        'user_id' => 1
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'body' => $faker->text,
        'post_id' => $faker->numberBetween(1,10),
        'user_id' => 1
    ];
});