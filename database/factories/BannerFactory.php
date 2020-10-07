<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Banner;
use Faker\Generator as Faker;

$factory->define(Banner::class, function (Faker $faker) {
    $start = $faker->dateTimeBetween('next Monday', 'next Monday +7 days');
    $end = $faker->dateTimeBetween($start, $start->format('Y-m-d') . ' +30 days');
    return [
        'name' => $faker->name,
        'image' => 'https://source.unsplash.com/random/600x400',
        'description' => $faker->paragraphs(3, true),
        'start_date' => $start,
        'end_date' => $end,
        'link' => $faker->url,
    ];
});
