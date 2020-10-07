<?php


/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:35 PM
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->unique->company,
        'logo' => 'https://source.unsplash.com/random/640x400',
        'description' => $faker->paragraphs(3, true),
        'website' => $faker->unique->url,
    ];
});
