<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorAddress extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vendor_addresses';

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
    protected $fillable = ['latitude', 'longitude', 'street', 'vendor_id', 'province_id', 'city_id', 'district_id',
        'village_id',
        'status'];

    /**
     * The attributes that for soft delete
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return BelongsTo
     */
    public function province()
    {
        return $this->belongsTo('App\Models\Province', 'province_id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function district()
    {
        return $this->belongsTo('App\Models\District', 'district_id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function village()
    {
        return $this->belongsTo('App\Models\Village', 'village_id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer');
    }
}
