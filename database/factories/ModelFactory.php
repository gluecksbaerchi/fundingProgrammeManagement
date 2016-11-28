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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'password' => bcrypt('12345678'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\FundingProgramme::class, function (Faker\Generator $faker) {
    return [
        'category_id' => factory(\App\Models\Category::class)->create()->id,
        'name' => $faker->name,
        'organisation' => $faker->name . ' org',
        'user_id' => factory(\App\Models\User::class)->create()->id
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Contact::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});
