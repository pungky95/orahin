<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Vendor;
use App\Models\VendorAddress;
use App\Traits\Authorizable;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use Throwable;

class VendorController extends Controller
{
    use Authorizable;

    public function __construct()
    {
        $this->phoneNumberUtil = PhoneNumberUtil::getInstance();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('dashboard.vendor.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function list()
    {
        return Laratables::recordsOf(Vendor::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('dashboard.vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws NumberParseException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:250',
            'description' => 'required|min:50',
            'logo' => 'required|image',
            'id_card' => 'required|image',
            'national_identity_number' => 'required|numeric|unique:vendors,national_identity_number,NULL,id,deleted_at,NULL',
            'id_card_with_customer' => 'required|image',
            'phone' => 'required|max:16|unique:vendors,phone,NULL,id,deleted_at,NULL',
            'customer_uid' => 'required|exists:customers,uid',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'village_id' => 'required|exists:villages,id',
            'street' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);
        if (Vendor::where('customer_uid', $request->customer_uid)->first()) {
            return redirect()->back()->with('error', 'This Customer already has Vendor')->withInput();
        }
        $customer = Customer::where('uid', $request->customer_uid)->first();
        if (!$customer) {
            return redirect()->back()->with('error', 'This Customer already has Vendor')->withInput();
        }
        if ($customer->email_verified === false) {
            return redirect()->back()->with('error', 'This Customer email is not verified yet')->withInput();
        }
        $requestData['phone'] = $this->phoneNumberUtil->parse($request->phone, 'ID');
        if (!$this->phoneNumberUtil->isValidNumber($requestData['phone'])) {
            return redirect()->back()->with('error', 'phone number is invalid')->withInput();
        }
        DB::transaction(function () use ($request) {
            $requestData = $request->all();
            $requestData['phone'] = $this->phoneNumberUtil->parse($requestData['phone'], 'ID');
            $requestData['phone'] = '+' . $requestData['phone']->getCountryCode() .
                $requestData['phone']->getNationalNumber();
            $vendor = Vendor::create($requestData);
            $address = new VendorAddress($requestData);
            $vendor->address()->save($address);
            Log::info('Create Vendor : ' . $vendor);
            Log::info('Create Vendor Address : ' . $vendor->address);
        });
        return redirect()->route('vendor.index')->with('success', 'Vendor created');
    }

    /**
     * Display the specified resource.
     *
     * @param Vendor $vendor
     * @return array|string
     * @throws Throwable
     */
    public function show(Vendor $vendor)
    {
        return view('dashboard.vendor.show', compact('vendor'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Vendor $vendor
     * @return Factory|View
     */
    public function edit(Vendor $vendor)
    {
        return view('dashboard.vendor.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Vendor $vendor
     * @return RedirectResponse
     * @throws ValidationException
     * @throws NumberParseException
     */
    public function update(Request $request, Vendor $vendor)
    {
        $this->validate($request, [
            'name' => 'required|max:250',
            'description' => 'required|min:50',
            'logo' => 'image',
            'id_card' => 'image',
            'national_identity_number' => 'required|numeric|unique:vendors,national_identity_number,' . $vendor->id . ',id,deleted_at,NULL',
            'id_card_with_customer' => 'image',
            'phone' => 'required|max:16|unique:vendors,phone,' . $vendor->id . ',id,deleted_at,NULL',
            'customer_uid' => 'required|exists:customers,uid',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'village_id' => 'required|exists:villages,id',
            'street' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);
        $requestData['phone'] = $this->phoneNumberUtil->parse($request->phone, 'ID');
        if (!$this->phoneNumberUtil->isValidNumber($requestData['phone'])) {
            return redirect()->back()->with('error', 'phone number is invalid');
        }
        DB::transaction(function () use ($request, $vendor) {
            $requestData = $request->all();
            $requestData['phone'] = $this->phoneNumberUtil->parse($requestData['phone'], 'ID');
            $requestData['phone'] = '+' . $requestData['phone']->getCountryCode() .
                $requestData['phone']->getNationalNumber();

            Log::info('Before update Vendor : ' . $vendor);
            Log::info('Before update Vendor Address : ' . $vendor->address);
            $vendor->update($requestData);
            $vendor->address()->delete();
            $address = new VendorAddress($requestData);
            $vendor->address()->save($address);
            Log::info('After update Vendor : ' . $vendor);
            Log::info('After update Vendor Address : ' . $vendor->address);
        });
        return redirect()->route('vendor.index')->with('success', 'Vendor updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Vendor $vendor
     * @return RedirectResponse
     */
    public function destroy(Vendor $vendor)
    {
        DB::transaction(function () use ($vendor) {
            Log::info('Delete Vendor : ' . $vendor);
            $vendor->delete();
        });
        return redirect()->route('vendor.index')->with('success', 'Vendor deleted');
    }

    /**
     * Update status the specified resource in storage.
     *
     * @param Request $request
     * @param Vendor $vendor
     * @return array|string
     * @throws Throwable
     */
    public function updateStatus(Request $request, Vendor $vendor)
    {
        DB::transaction(function () use ($vendor) {
            $requestData['status'] = 'Active';
            if ($vendor->status == 'Active') {
                $requestData['status'] = 'Inactive';
            }
            Log::info('Before update Vendor : ' . $vendor);
            $vendor->update($requestData);
            Log::info('After update Vendor : ' . $vendor);
        });
        return redirect()->route('vendor.index')->with('success', 'Vendor updated');
    }

    /**
     * Verify ID Card
     *
     * @param Vendor $vendor
     * @return RedirectResponse
     */
    public function updateIdCardVerify(Vendor $vendor)
    {
        DB::transaction(function () use ($vendor) {
            $requestData['id_card_verified'] = 'Verified';
            Log::info('Before update Vendor : ' . $vendor);
            $vendor->update($requestData);
            Log::info('After update Vendor : ' . $vendor);
        });
        return redirect()->route('vendor.index')->with('success', 'Vendor updated');
    }

    /**
     * Reject ID Card
     *
     * @param Vendor $vendor
     * @return RedirectResponse
     */
    public function updateIdCardReject(Vendor $vendor)
    {
        DB::transaction(function () use ($vendor) {
            $requestData['id_card_verified'] = 'Reject';
            Log::info('Before update Vendor : ' . $vendor);
            $vendor->update($requestData);
            Log::info('After update Vendor : ' . $vendor);
        });
        return redirect()->route('vendor.index')->with('success', 'Vendor updated');
    }
}
