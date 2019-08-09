<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Delivery;
use Faker\Generator as Faker;

$factory->define(Delivery::class, function (Faker $faker) {
    $r = rand(0, 10);
    return [
        'name'      => $faker->words(rand(1,3), true),
        'full_text' => $faker->text(2000),
        'price'     => $r > 5 ? rand(10, 50) : 0,
        'free_from' => $r > 5 ? rand(100, 500) : 0,
        'icon'      => $faker->image(config('filesystems.disks.public.root').'/'.Delivery::$originalDir[0], 80, 60, null, false),
    ];
});
