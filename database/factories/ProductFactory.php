<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->words(rand(1,3), true);
    return [
        'name' => $name,
        'url' => uniqid(),
        'meta_title' => $name,
        'meta_keywords' => $name,
        'meta_description' => $name,
        'short_text' => $faker->text(),
        'full_text' => $faker->text(2000),
        'image' => $faker->image(config('filesystems.disks.public.root').'/'.Product::$originalDir[0], 640, 480, null, false),
        'image2' => $faker->image(config('filesystems.disks.public.root').'/'.Product::$originalDir[1], 640, 480, null, false),
    ];
});
