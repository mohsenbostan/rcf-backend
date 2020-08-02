<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\Answer::class, function (Faker $faker) {
    return [
        'content' => $faker->realText(),
        'thread_id' => \factory(\App\Thread::class)->create()->id,
        'user_id' => \factory(\App\User::class)->create()->id,
    ];
});
