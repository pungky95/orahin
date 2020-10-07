<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Throwable;

class Customer extends Authenticatable
{
    use SoftDeletes, Notifiable, HasApiTokens;


    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';
    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'uid';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['uid', 'photo_profile', 'name', 'phone_number', 'email', 'gender',
        'email_verified'];

    /**
     * @param $customer
     * @return array|string
     * @throws Throwable
     */
    public static function laratablesCustomInfo($customer)
    {
        $arrColor = ['primary', 'danger', 'success', 'warning'];
        $color = $arrColor[rand(0, 3)];
        return view('dashboard.customer.info', compact('customer', 'color'))->render();
    }

    /**
     * @param $model
     * @return array|string
     * @throws Throwable
     */
    public static function laratablesCustomEmailVerifiedBadge($model)
    {
        return view('dashboard.customer.email_verified_badge', compact('model'))->render();
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param Customer
     * @return string
     * @throws Throwable
     */
    public static function laratablesCustomAction($customer)
    {
        return view('dashboard.customer.action', compact('customer'))->render();
    }

    /**
     * Adds the condition for searching the name and email of the customer in the query.
     *
     * @param Builder
     * @param string search term
     * @return Builder
     */
    public static function laratablesSearchInfo($query, $searchValue)
    {
        return $query->orWhere('name', 'like', '%' . $searchValue . '%')
            ->orWhere('email', 'like', '%' . $searchValue . '%');
    }

    /**
     * Adds the condition for searching the email verified of the customer in the query.
     *
     * @param Builder
     * @param string search term
     * @return Builder
     */
    public static function laratablesSearchEmailVerifiedBadge($query, $searchValue)
    {
        return $query->orWhere('email_verified', 'like', '%' . $searchValue . '%');
    }

    /**
     * Additional columns to be loaded for datatables.
     *
     * @return array
     */
    public static function laratablesAdditionalColumns()
    {
        return ['name', 'email_verified', 'email'];
    }

    /**
     * @param $direction
     * @return string
     */
    public static function laratablesOrderRawInfo($direction)
    {
        return 'name ' . $direction . ', email ' . $direction;
    }

    /**
     * @return string
     */
    public static function laratablesOrderEmailVerifiedBadge()
    {
        return 'email_verified';
    }

    /**
     * @return string
     */
    public function getFullPhoneNumberAttribute()
    {
        return "{$this->country_code}{$this->phone_number}";
    }

    /**
     * @return HasOne
     */
    public function vendor()
    {
        return $this->hasOne('App\Models\Vendor', 'customer_uid', 'uid');
    }

    public function favoriteItems()
    {
        return $this->belongsToMany('App\Models\Service', 'favorite_items', 'customer_uid', 'service_id')->withPivot('created_at');
    }
}
