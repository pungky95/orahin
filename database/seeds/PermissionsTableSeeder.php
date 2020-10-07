<?php


/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:35 PM
 */

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = array('create', 'read', 'update', 'delete');
        foreach ($permission as $key => $value) {
            Permission::create(['name' => $value . '_customer']);
        }
        foreach ($permission as $key => $value) {
            Permission::create(['name' => $value . '_vendor']);
        }
        foreach ($permission as $key => $value) {
            Permission::create(['name' => $value . '_banner']);
        }
        foreach ($permission as $key => $value) {
            Permission::create(['name' => $value . '_company']);
        }
        foreach ($permission as $key => $value) {
            Permission::create(['name' => $value . '_bulletin']);
        }
        foreach ($permission as $key => $value) {
            Permission::create(['name' => $value . '_category']);
        }
        foreach ($permission as $key => $value) {
            Permission::create(['name' => $value . '_subcategory']);
        }

    }
}
