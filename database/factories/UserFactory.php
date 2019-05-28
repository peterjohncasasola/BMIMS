<?php

use App\User;
use App\Resident;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});


$factory->define(Resident::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'middle_name' => $faker->lastName,
        'last_name' => $faker->lastName,
        'house_no' => $faker->buildingNumber,
        'street_address' => $faker->streetAddress,
        'title' => $faker->title,
        'birth_place' => $faker->address,
        'birth_date' => $faker->date,
        'course_degree' => $faker->bs,
        'email' => $faker->email,
        'contact_no' => $faker->e164PhoneNumber,
        'occupation' => $faker->jobTitle,

    ];
});
