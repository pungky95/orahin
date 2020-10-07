<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

namespace App\Models;

use App\Traits\MediaHandling;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Throwable;

class Company extends Model
{
    use SoftDeletes, MediaHandling;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

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
    protected $fillable = ['name', 'logo', 'description', 'website', 'status'];

    /**
     * @param $company
     * @return array|string
     * @throws Throwable
     */
    public static function laratablesCustomAction($company)
    {
        return view('dashboard.company.action', compact('company'))->render();
    }

    /**
     * @return string
     */
    public static function laratablesOrderStatusBadge()
    {
        return 'status';
    }

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
     * @param $query
     * @param $searchValue
     * @return mixed
     */
    public static function laratablesSearchStatusBadge($query, $searchValue)
    {
        return $query->orWhere('status', 'like', '%' . $searchValue . '%');
    }

    /**
     * Additional columns to be loaded for datatables.
     *
     * @return array
     */
    public static function laratablesAdditionalColumns()
    {
        return ['status'];
    }

    /**
     * @return HasMany
     */
    public function bulletins()
    {
        return $this->hasMany('App\Models\Bulletin', 'company_id', 'id');
    }

    /**
     * @param $logo
     */
    public function setLogoAttribute($logo)
    {
        $this->attributes['logo'] = $logo;
        if (filter_var($logo, FILTER_VALIDATE_URL) === FALSE) {
            $this->attributes['logo'] = Storage::url($this->upload($logo, 'company/logo/', null, null, 70));
        }
    }
}
