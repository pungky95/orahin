<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorResource;
use App\Models\Customer;
use App\Models\Vendor;
use App\Models\VendorAddress;
use App\Models\Village;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use libphonenumber\PhoneNumberUtil;


class VendorController extends Controller
{
    public function __construct()
    {
        $this->phoneNumberUtil = PhoneNumberUtil::getInstance();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return VendorResource
     */
    public function store(Request $request)
    {
        if (Vendor::where('customer_uid', $request->user()->uid)->first()) {
            return errorResponse('Not allowed to create another vendor', 403);
        }
        $customer = Customer::where('uid', $request->user()->uid)->first();
        if (!$customer) {
            return errorResponse('Customer not found', 404);
        }
        if ($customer->email_verified === false) {
            return errorResponse('Your email is not verified yet', 403);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:250',
            'description' => 'required|min:50',
            'logo' => 'required|image',
            'id_card' => 'required|image',
            'national_identity_number' => 'required|unique:vendors,national_identity_number,NULL,id,deleted_at,NULL',
            'id_card_with_customer' => 'required|image',
            'phone' => 'required|max:20|unique:vendors,phone,NULL,id,deleted_at,NULL',
            'village_id' => 'required|exists:villages,id',
            'street' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $requestData = $request->all();
        $village = Village::findOrFail($requestData['village_id']);
        $requestData['district_id'] = $village->district->id;
        $requestData['city_id'] = $village->district->city->id;
        $requestData['province_id'] = $village->district->city->province->id;
        DB::beginTransaction();
        try {
            $requestData['customer_uid'] = $request->user()->uid;
            $requestData['phone'] = $this->phoneNumberUtil->parse($requestData['phone'], 'ID');
            if (!$this->phoneNumberUtil->isValidNumber($requestData['phone'])) {
                return errorResponse('phone number is invalid', 400);
            }
            $requestData['phone'] = '+' . $requestData['phone']->getCountryCode() .
                $requestData['phone']->getNationalNumber();
            $vendor = Vendor::create($requestData);
            $address = new VendorAddress($requestData);
            $vendor->address()->save($address);
            Log::info('Create Vendor : ' . $vendor);
            DB::commit();
            return (new VendorResource($vendor));
        } catch (Exception $e) {
            DB::rollBack();
            return errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return VendorResource
     */
    public function myVendor(Request $request)
    {
        $vendor = Vendor::where('customer_uid', $request->user()->uid)->first();
        if (!$vendor) {
            return response()->json(['data' => null]);
        }
        return new VendorResource($vendor);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return VendorResource
     */
    public function show(Vendor $vendor)
    {
        return new VendorResource($vendor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Vendor $vendor
     * @return VendorResource
     */
    public function update(Request $request)
    {
        if (!Vendor::where('customer_uid', $request->user()->uid)->first()) {
            return errorResponse("You don't have vendor yet.", 404);
        }
        $vendor = Vendor::where('customer_uid', $request->user()->uid)->first();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:250',
            'description' => 'required|min:50',
            'logo' => 'image',
            'id_card' => 'image',
            'national_identity_number' => 'required|unique:vendors,national_identity_number,' . $vendor->id . ',id,deleted_at,NULL',
            'id_card_with_customer' => 'image',
            'phone' => 'required|max:20|unique:vendors,phone,' . $vendor->id . ',id,deleted_at,NULL',
            'village_id' => 'required|exists:villages,id',
            'street' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $requestData = $request->all();
        $village = Village::findOrFail($requestData['village_id']);
        $requestData['district_id'] = $village->district->id;
        $requestData['city_id'] = $village->district->city->id;
        $requestData['province_id'] = $village->district->city->province->id;
        DB::beginTransaction();
        try {
            $requestData['customer_uid'] = $request->user()->uid;
            $requestData['phone'] = $this->phoneNumberUtil->parse($requestData['phone'], 'ID');
            if (!$this->phoneNumberUtil->isValidNumber($requestData['phone'])) {
                return errorResponse('No telepon tidak valid', 400);
            }
            $requestData['phone'] = '+' . $requestData['phone']->getCountryCode() .
                $requestData['phone']->getNationalNumber();
            Log::info('Before update : ' . $vendor);
            $vendor->update($requestData);
            $vendor->address()->delete();
            $address = new VendorAddress($requestData);
            $vendor->address()->save($address);
            Log::info('After update Vendor : ' . $vendor);
            DB::commit();
            return (new VendorResource($vendor));
        } catch (Exception $e) {
            DB::rollBack();
            return errorResponse($e->getMessage(), 500);
        }
    }

    public function updateLogo(Request $request)
    {
        if (!Vendor::where('customer_uid', $request->user()->uid)->first()) {
            return errorResponse("You don't have vendor yet.", 404);
        }
        $vendor = Vendor::where('customer_uid', $request->user()->uid)->first();
        $validator = Validator::make($request->all(), [
            'logo' => 'required|image',
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $requestData = $request->all();
        DB::beginTransaction();
        try {
            Log::info('Before update : ' . $vendor);
            $vendor->update($requestData);
            Log::info('After update Vendor : ' . $vendor);
            DB::commit();
            return (new VendorResource($vendor));
        } catch (Exception $e) {
            DB::rollBack();
            return errorResponse($e->getMessage(), 500);
        }
    }
}
