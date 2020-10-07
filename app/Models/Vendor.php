<?php
/**
 *  Copyright (c) 2020. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.com
 * @date 1/19/20, 2:10 AM
 */

namespace App\Models;

use App\Traits\MediaHandling;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Throwable;

class Vendor extends Model
{
    use SoftDeletes, MediaHandling;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vendors';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'customer_uid', 'description', 'logo', 'id_card', 'national_identity_number', 'phone', 'status',
        'id_card_verified', 'id_card_with_customer'];

    /**
     * @param $model
     * @return array|string
     * @throws Throwable
     */
    public static function laratablesCustomStatusBadge($model)
    {
        return view('dashboard.layouts.component.badge', compact('model'))->render();
    }

    /**
     * @param Vendor $vendor
     * @return array|string
     * @throws Throwable
     */
    public static function laratablesCustomIdCardVerifiedBadge($vendor)
    {
        return view('dashboard.vendor.id_card_verified_badge', compact('vendor'))->render();
    }

    /**
     * @return string
     */
    public static function laratablesOrderIdCardVerifiedBadge()
    {
        return 'id_card_verified';
    }

    public static function laratablesSearchStatusBadge($query, $searchValue)
    {
        return $query->orWhere('status', 'like', '%' . $searchValue . '%');
    }

    public static function laratablesSearchIdCardVerifiedBadge($query, $searchValue)
    {
        return $query->orWhere('id_card_verified', 'like', '%' . $searchValue . '%');
    }

    public static function laratablesOrderStatusBadge()
    {
        return 'status';
    }

    /**
     * @param $vendor
     * @return array|string
     * @throws Throwable
     */
    public static function laratablesCustomAction($vendor)
    {
        return view('dashboard.vendor.action', compact('vendor'))->render();
    }

    /**
     * id_card_verified column should be used for sorting when name column is selected in Datatables.
     *
     * @return string
     */
    public static function laratablesOrderIdCardVerified()
    {
        return 'id_card_verified';
    }

    /**
     * status column should be used for sorting when name column is selected in Datatables.
     *
     * @return string
     */
    public static function laratablesOrderStatus()
    {
        return 'status';
    }

    /**
     * Additional columns to be loaded for datatables.
     *
     * @return array
     */
    public static function laratablesAdditionalColumns()
    {
        return ['status', 'id_card_verified'];
    }

    /**
     * @return string
     */
    public function getAddressDetailAttribute()
    {
        if ($this->address()->exists()) {
            return $this->address->street .
                ', ' . $this->address->village->name .
                ', ' . $this->address->district->name .
                ', ' . $this->address->city->name .
                ', ' . $this->address->province->name;
        }
        return null;
    }

    /**
     * @return HasOne
     */
    public function address()
    {
        return $this->hasOne('App\Models\VendorAddress', 'vendor_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_uid', 'uid')->withTrashed()->withDefault(null);
    }

    /**
     * @param $logo
     */
    public function setLogoAttribute($logo)
    {
        $this->attributes['logo'] = $logo;
        if (filter_var($logo, FILTER_VALIDATE_URL) === FALSE) {
            $this->attributes['logo'] = Storage::url($this->upload($logo, 'vendor/logo/', null, null, 70));
        }
    }

    /**
     * @param $idCard
     */
    public function setIdCardAttribute($idCard)
    {
        $this->attributes['id_card'] = $idCard;
        if (filter_var($idCard, FILTER_VALIDATE_URL) === FALSE) {
            $this->attributes['id_card'] = Storage::url($this->upload($idCard, 'vendor/id_card/', null, null, 70));
        }

    }

    /**
     * @param $idCardWithCustomer
     */
    public function setIdCardWithCustomerAttribute($idCardWithCustomer)
    {
        $this->attributes['id_card_with_customer'] = $idCardWithCustomer;
        if (filter_var($idCardWithCustomer, FILTER_VALIDATE_URL) === FALSE) {
            $this->attributes['id_card_with_customer'] =
                Storage::url($this->upload($idCardWithCustomer, 'vendor/id_card_with_customer/', null, null, 70));
        }

    }
}
