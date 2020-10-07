<?php


/**
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Pungky Kurniawan',
            'email' => 'pungky@orahin.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole('Super Admin');
        $user = User::create([
            'name' => 'Wahyu Dyatmika',
            'email' => 'wahyu@orahin.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole('Super Admin');
    }
}
