<?php


/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:35 PM
 */

use App\Models\Customer;
use App\Models\Vendor;
use App\Models\VendorAddress;
use Illuminate\Database\Seeder;
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Exception\FirebaseException;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws AuthException
     * @throws FirebaseException
     */
    public function run()
    {
        foreach (range(1, 10) as $i) {
            $customer = factory(Customer::class)->create();
            $vendor = factory(Vendor::class)->create([
                'customer_uid' => $customer->uid,
            ]);
            $vendorAddress = factory(VendorAddress::class)->create([
                'vendor_id' => $vendor->id
            ]);
        }

    }
}
