<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use App\Models\Vendor;
use Faker\Generator as Faker;

$factory->define(Vendor::class, function (Faker $faker) {
    $customers = Customer::all();
    $customerId = 0;
    foreach ($customers as $customer) {
        $customerId = $customer->id;
    }
    return [
        'name' => $faker->company,
        'customer_uid' => $customerId,
        'description' => $faker->paragraphs(3, true),
        'logo' => 'https://source.unsplash.com/random/640x400',
        'id_card' => 'https://source.unsplash.com/random/640x400',
        'national_identity_number' => $faker->nationalIdNumber,
        'id_card_with_customer' => 'https://staging-media-orahin.sgp1.digitaloceanspaces.com/Staging/default/elliott-engelmann-30045-unsplash.jpg',
        'id_card_verified' => 'Unverified',
        'phone' => $customer->phone_number,
        'status' => 'Active',
    ];
});
