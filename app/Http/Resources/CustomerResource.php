<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     * @throws NumberParseException
     */
    public function toArray($request)
    {
        $phoneNumber = null;
        if ($this->phone_number != null) {
            $phoneNumberUtil = PhoneNumberUtil::getInstance();
            $phoneNumber = $phoneNumberUtil->parse($this->phone_number, 'ID');
        }
        return [
            'uid' => $this->uid,
            'name' => $this->name,
            'email' => $this->email,
            'photo_profile' => $this->photo_profile,
            'phone_number' => $phoneNumber != null ? $phoneNumber->getNationalNumber() : $phoneNumber,
            'phone_number_with_country_code' => $this->phone_number,
            'gender' => $this->gender,
            'email_verified' => booleanConverter($this->email_verified),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
