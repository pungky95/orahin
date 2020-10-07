<?php

use App\Models\Vendor;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Vendor::create([
            'name' => $faker->company,
            'customer_id' => 1,
            'description' => $faker->paragraphs(3, true),
            'logo' => 'dummy/elliott-engelmann-30045-unsplash.jpg',
            'id_card' => 'dummy/elliott-engelmann-30045-unsplash.jpg',
            'phone' => $faker->phoneNumber,
            'status' => 'Active',
        ]);
    }
}
