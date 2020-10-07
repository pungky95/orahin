<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\City;
use App\Models\District;
use App\Models\Province;
use App\Models\VendorAddress;
use App\Models\Village;
use Faker\Generator as Faker;

$factory->define(VendorAddress::class, function (Faker $faker) {
    $provinces = Province::all();
    $selectedProvince = $provinces->random()->id;
    $cities = City::where('province_id', $selectedProvince)->get();
    $selectedCity = $cities->random()->id;
    $districts = District::where('city_id', $selectedCity)->get();
    $selectedDistrict = $districts->random()->id;
    $selectedVillage = Village::where('district_id', $selectedDistrict)->first();
    return [
        'latitude' => $faker->latitude(-8, 1),
        'longitude' => $faker->longitude(95, 134),
        'street' => $faker->address,
        'province_id' => $selectedProvince,
        'city_id' => $selectedCity,
        'district_id' => $selectedDistrict,
        'village_id' => $selectedVillage,
    ];
});
