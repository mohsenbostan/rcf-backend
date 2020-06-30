<?php

/** @var Factory $factory */

use App\Channel;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Channel::class, function (Faker $faker) {
    $name = $faker->sentence(4);
    return [
        'name' => $name,
        'slug' => \Illuminate\Support\Str::slug($name)
    ];
});
