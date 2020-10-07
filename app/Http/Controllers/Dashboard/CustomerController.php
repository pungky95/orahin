<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.uid
 * @date 12/15/19, 3:34 PM
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Notifications\SendPasswordNewCustomer;
use App\Traits\Authorizable;
use App\Traits\MediaHandling;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Kreait\Firebase\Factory as FactoryFirebase;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use Throwable;

class CustomerController extends Controller
{
    use Authorizable, MediaHandling;

    public function __construct()
    {
        $this->auth = (new FactoryFirebase)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->createAuth();
        $this->phoneNumberUtil = PhoneNumberUtil::getInstance();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('dashboard.customer.index');
    }

    public function list()
    {
        return Laratables::recordsOf(Customer::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('dashboard.customer.create');
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
            'photo_profile' => 'image',
            'name' => 'string|required|max:250',
            'email' => 'email|required|unique:customers,email,NULL,uid,deleted_at,NULL',
            'phone_number' => 'required|max:16|unique:customers,phone_number,NULL,uid,deleted_at,NULL',
            'gender' => 'required|in:Male,Female',
        ]);
        if (!$this->phoneNumberUtil->isValidNumber($this->phoneNumberUtil->parse($request->phone_number, 'ID'))) {
            return redirect()->back()->with('error', 'phone number is invalid');
        }


        DB::transaction(function () use ($request) {
            $requestData = $request->all();
            if ($request->filled('photo_profile')) {
                $requestData['photo_profile'] =
                $photoProfile = Storage::url($this->upload($requestData['photo_profile'], 'customer/photo_profile', null, null,
                    70));
            }
            $requestData['password'] = randomPassword();
            $requestData['phone_number'] = $this->phoneNumberUtil->parse($requestData['phone_number'], 'ID');
            $requestData['phone_number'] = '+' . $requestData['phone_number']->getCountryCode() .
                $requestData['phone_number']->getNationalNumber();

            $customerFirebase = $this->auth->createUser([
                'photoUrl' => $request->filled('photo_profile') ? $requestData['photo_profile'] : '',
                'email' => $requestData['email'],
                'emailVerified' => false,
                'phoneNumber' => $requestData['phone_number'],
                'password' => $requestData['password'],
                'displayName' => $requestData['name'],
            ]);
            $requestData['uid'] = $customerFirebase->uid;
            $customer = Customer::create($requestData);
            $customer->notify(new SendPasswordNewCustomer($customer, $requestData['password']));
            Log::info('Store Customer : ' . $customer);
        });
        return redirect()->route('customer.index')->with('success', 'Customer created');
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return array|string
     * @throws Throwable
     */
    public function show(Customer $customer)
    {
        return view('dashboard.customer.show', compact('customer'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return Factory|View
     */
    public function edit(Customer $customer)
    {
        return view('dashboard.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Customer $customer
     * @return array|string
     * @throws Throwable
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'photo_profile' => 'image',
            'name' => 'string|required|max:250',
            'email' => 'email|required|unique:customers,email,' . $customer->uid . ',uid,deleted_at,NULL',
            'phone_number' => 'required|max:16|unique:customers,phone_number,' . $customer->uid .
                ',uid,deleted_at,NULL',
            'gender' => 'required|in:Male,Female',
        ]);
        if (!$this->phoneNumberUtil->isValidNumber($this->phoneNumberUtil->parse($request->phone_number, 'ID'))) {
            return redirect()->back()->with('error', 'phone number is invalid');
        }
        DB::transaction(function () use ($request, $customer) {
            $requestData = $request->all();
            if ($request->filled('photo_profile')) {
                $requestData['photo_profile'] =
                $photoProfile = Storage::url($this->upload($requestData['photo_profile'], 'customer/photo_profile/', null, null,
                    70));
            }
            $requestData['phone_number'] = $this->phoneNumberUtil->parse($requestData['phone_number'], 'ID');
            $requestData['phone_number'] = '+' . $requestData['phone_number']->getCountryCode() .
                $requestData['phone_number']->getNationalNumber();
            $this->auth->updateUser($customer->uid, [
                'photoUrl' => $request->filled('photo_profile') ? $requestData['photo_profile'] : '',
                'email' => $requestData['email'],
                'phoneNumber' => $requestData['phone_number'],
                'displayName' => $requestData['name'],
            ]);
            Log::info('Before update Customer : ' . $customer);
            $customer->update($requestData);
            Log::info('After update Customer : ' . $customer);
        });
        return redirect()->route('customer.index')->with('success', 'Customer updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function destroy(Customer $customer)
    {
        DB::transaction(function () use ($customer) {
            $this->auth->deleteUser($customer->uid);
            Log::info('Delete Customer : ' . $customer);
            $customer->delete();
        });
        return redirect()->route('customer.index')->with('success-sweetalert', 'Company deleted');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function updateStatus(Request $request, Customer $customer)
    {
        DB::transaction(function () use ($customer) {
            $requestData['email_verified'] = true;
            if ($customer->email_verified == true) {
                $requestData['email_verified'] = false;
            }
            $this->auth->updateUser($customer->uid, [
                'emailVerified' => $requestData['email_verified'],
            ]);
            Log::info('Before update Customer : ' . $customer);
            $customer->update($requestData);
            Log::info('After update Customer : ' . $customer);
        });
        return redirect()->route('customer.index')->with('success', 'Customer updated');
    }
}
