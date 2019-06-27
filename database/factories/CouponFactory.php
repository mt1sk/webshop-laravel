<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Coupon;
use Faker\Generator as Faker;

$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'code' => uniqid(),
        'value' => rand(10, 100),
    ];
});
