<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'name' => $faker->words(rand(1,3), true),
        'full_text' => $faker->text(2000),
        'icon' => $faker->image(config('filesystems.disks.public.root').'/'.Payment::$originalDir[0], 640, 480, null, false),
    ];
});
