<?php


/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:35 PM
 */

/** @var Factory $factory */

use App\Models\Customer;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Carbon;
use Kreait\Firebase\Factory as FactoryFirebase;
use libphonenumber\PhoneNumberUtil;

$factory->define(Customer::class, function (Faker $faker) {
    $number = rand(0, 11);
    $name = $faker->unique->name;
    $email = $faker->unique->email;
    $phoneNumber = $faker->phoneNumber;
    $date = Carbon::now()->addMonths($number);
    $password = bcrypt('12345678');
    $phoneNumberUtil = PhoneNumberUtil::getInstance();
    $phoneNumber = $phoneNumberUtil->parse($phoneNumber, 'ID');
    $phoneNumber = '+' . $phoneNumber->getCountryCode() .
        $phoneNumber->getNationalNumber();
    $auth = (new FactoryFirebase)
        ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
        ->createAuth();
    $customerFirebase = '';
    if (env('APP_ENV') != 'local') {
        $customerFirebase = $auth->createUser([
            'photoUrl' => 'https://source.unsplash.com/random/640x400',
            'email' => $email,
            'emailVerified' => false,
            'phoneNumber' => $phoneNumber,
            'password' => $password,
            'displayName' => $name,
        ]);
    }
    return [
        'uid' => $customerFirebase ? $customerFirebase->uid : uniqid(),
        'photo_profile' => 'https://source.unsplash.com/random/640x400',
        'name' => $name,
        'email' => $email,
        'phone_number' => $phoneNumber,
        'email_verified' => false,
        'created_at' => $date,
        'updated_at' => $date,
    ];
});
