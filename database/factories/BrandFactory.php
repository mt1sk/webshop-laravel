<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Brand;
use Faker\Generator as Faker;

$factory->define(Brand::class, function (Faker $faker) {
    $name = $faker->words(rand(1,3), true);
    return [
        'name' => $name,
        'url' => uniqid(),
        'meta_title' => $name,
        'meta_keywords' => $name,
        'meta_description' => $name,
        'short_text' => $faker->text(),
        'full_text' => $faker->text(2000),
        'img' => $faker->image(config('filesystems.disks.public.root').'/'.Brand::$originalDir[0], 640, 480, null, false),
    ];
});
