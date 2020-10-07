<?php


/**
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subcategory;
use Faker\Generator as Faker;

$factory->define(Subcategory::class, function (Faker $faker) {
    return [
        'image' => 'https://source.unsplash.com/random/640x400',
        'name' => $faker->unique->jobTitle,
    ];
});
