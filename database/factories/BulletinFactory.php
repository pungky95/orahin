<?php


/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:35 PM
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Bulletin;
use Faker\Generator as Faker;

$factory->define(Bulletin::class, function (Faker $faker) {
    $timePeriodList = ['Day', 'Week', 'Month'];
    $start = $faker->dateTimeBetween('next Monday', 'next Monday +7 days');
    $end = $faker->dateTimeBetween($start, $start->format('Y-m-d') . ' +30 days');
    return [
        'job_name' => $faker->jobTitle,
        'description' => $faker->paragraphs(3, true),
        'salary' => $faker->numberBetween(500000, 20000000),
        'time_period' => $timePeriodList[rand(0, 2)],
        'start_date' => $start,
        'end_date' => $end
    ];
});
