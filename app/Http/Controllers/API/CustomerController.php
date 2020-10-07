<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Traits\MediaHandling;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Factory as FactoryFirebase;
use libphonenumber\PhoneNumberUtil;

class CustomerController extends Controller
{
    use MediaHandling;

    public function __construct()
    {
        $this->auth = (new FactoryFirebase)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->createAuth();
        $this->phoneNumberUtil = PhoneNumberUtil::getInstance();
    }

    /**
     * @param Request $request
     * @return CustomerResource|JsonResponse
     * @throws AuthException
     * @throws FirebaseException
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:250',
            'email' => 'required|email|max:200',
            'password' => 'required|min:8|confirmed',
            'phone_number' => 'required|max:30',
            'gender' => 'in:Male,Female|nullable'
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $requestData = $request->all();
        DB::beginTransaction();
        try {
            $requestData['phone_number'] = $this->phoneNumberUtil->parse($requestData['phone_number'], 'ID');
            if (!$this->phoneNumberUtil->isValidNumber($requestData['phone_number'])) {
                return redirect()->back()->with('danger', 'phone number is invalid');
            }
            $requestData['phone_number'] = '+' . $requestData['phone_number']->getCountryCode() .
                $requestData['phone_number']->getNationalNumber();
            $customerFirebaseAuth = $this->auth->createUser([
                'email' => $requestData['email'],
                'emailVerified' => false,
                'phoneNumber' => $requestData['phone_number'],
                'password' => $requestData['password'],
                'displayName' => $requestData['name'],
            ]);
            $requestData['uid'] = $customerFirebaseAuth->uid;
            $customer = Customer::create([
                'uid' => $customerFirebaseAuth->uid,
                'name' => $customerFirebaseAuth->displayName,
                'email' => $customerFirebaseAuth->email,
                'photo_profile' => $customerFirebaseAuth->photoUrl !== null ?
                    $customerFirebaseAuth->photoUrl : null,
                'email_verified' => $customerFirebaseAuth->emailVerified == false ? 0 : 1,
                'phone_number' => $customerFirebaseAuth->phoneNumber !== null ? $customerFirebaseAuth->phoneNumber :
                    null,
                'gender' => null,
            ]);
            Log::info('Store Customer : ' . $customer);
            $tokenGenerate = $customer->createToken('token');
            DB::commit();
            return (new CustomerResource($customer))->additional([
                'token' => $tokenGenerate->accessToken,
                'expired_token' => $tokenGenerate->token->expires_at
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * @param Request $request
     * @return CustomerResource|JsonResponse
     * @throws AuthException
     * @throws FirebaseException
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uid' => 'required|string'
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        try {
            $customer = Customer::find($request->uid);
            if (!$customer) {
                $customerFirebaseAuth = $this->auth->getUser($request->uid);
                $customer = Customer::create([
                    'uid' => $customerFirebaseAuth->uid,
                    'name' => $customerFirebaseAuth->displayName,
                    'email' => $customerFirebaseAuth->email,
                    'photo_profile' => $customerFirebaseAuth->photoUrl !== null ?
                        $customerFirebaseAuth->photoUrl : null,
                    'email_verified' => $customerFirebaseAuth->emailVerified,
                    'phone_number' => $customerFirebaseAuth->phoneNumber !== null ? $customerFirebaseAuth->phoneNumber :
                        null
                ]);
            }
            $tokenGenerate = $customer->createToken('token');
            return (new CustomerResource($customer))->additional([
                'token' => $tokenGenerate->accessToken,
                'expired_token' => $tokenGenerate->token->expires_at
            ]);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();
            return response()->json(['data' => true]);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * @param Request $request
     * @return CustomerResource|JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws AuthException
     * @throws FirebaseException
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|max:250',
            'email' => 'email|required|unique:customers,email,' . $request->user()->uid . ',uid,deleted_at,NULL',
            'phone_number' => 'required|unique:customers,phone_number,' . $request->user()->uid .
                ',uid,deleted_at,NULL',
            'gender' => 'in:Male,Female',
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 500);
        }
        DB::beginTransaction();
        $requestData = $request->all();
        try {
            $requestData['phone_number'] = $this->phoneNumberUtil->parse($requestData['phone_number'], 'ID');
            if (!$this->phoneNumberUtil->isValidNumber($requestData['phone_number'])) {
                return redirect()->back()->with('danger', 'phone number is invalid');
            }
            $requestData['phone_number'] = '+' . $requestData['phone_number']->getCountryCode() .
                $requestData['phone_number']->getNationalNumber();
            Log::info('Before update Customer : ' . $request->user());
            $request->user()->update($requestData);
            $this->auth->updateUser($request->user()->uid, [
                'displayName' => $requestData['name'],
                'email' => $requestData['email'],
                'phoneNumber' => $requestData['phone_number'],
            ]);
            Log::info('After update Customer : ' . $request->user());
            DB::commit();
            return (new CustomerResource($request->user()));
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * @param Request $request
     * @return CustomerResource|JsonResponse
     */
    public function currentCustomer(Request $request)
    {
        try {
            $customer = $request->user();
            return (new CustomerResource($customer));
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * @param Request $request
     * @return CustomerResource|JsonResponse
     * @throws AuthException
     * @throws FirebaseException
     */
    public function updatePhotoProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpg,jpeg,png',
            'quality' => 'required|numeric|min:60|max:100'
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        DB::beginTransaction();
        try {
            $photoProfile = Storage::url($this->
            upload(
                $request->file,
                'customer/photo_profile/',
                null,
                null,
                $request->quality
            ));
            Log::info('Before update Customer : ' . $request->user());
            $request->user()->photo_profile = $photoProfile;
            $request->user()->save();
            $this->auth->updateUser($request->user()->uid, ['photoURL' => $photoProfile]);
            Log::info('After update Customer : ' . $request->user());
            DB::commit();
            return (new CustomerResource($request->user()));
        } catch (Exception $e) {
            DB::rollBack();
            return errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * @param Request $request
     * @return bool|JsonResponse
     * @throws AuthException
     * @throws FirebaseException
     */
    public function verifyEmail(Request $request)
    {
        $data['data']['email_verified'] = false;
        try {
            $customer = Customer::find($request->user()->uid);
            if ($customer) {
                $customerFirebaseAuth = $this->auth->getUser($request->user()->uid);
                if ($customerFirebaseAuth) {
                    $customer->update([
                        'email_verified' => $customerFirebaseAuth->emailVerified,
                    ]);
                    $data['data']['email_verified'] = $customerFirebaseAuth->emailVerified;
                }
            }
            return $data;
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), 500);
        }
    }
}
