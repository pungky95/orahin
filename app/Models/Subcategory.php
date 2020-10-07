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
use Illuminate\Support\Facades\Storage;
use Throwable;
use App\Traits\MediaHandling;

class Subcategory extends Model
{
    use SoftDeletes,MediaHandling;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subcategories';

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
    protected $fillable = ['category_id','image', 'name', 'status'];

    /**
     * @param $subcategory
     * @return array|string
     * @throws Throwable
     */
    public static function laratablesCustomAction($subcategory)
    {
        return view('dashboard.subcategory.action', compact('subcategory'))->render();
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
     * @return string
     */
    public static function laratablesOrderStatusBadge()
    {
        return 'status';
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
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    /**
     * @param $image
     */
    public function setImageAttribute($image)
    {
        $this->attributes['image'] = $image;
        if (filter_var($image, FILTER_VALIDATE_URL) === FALSE) {
            $this->attributes['image'] = Storage::url($this->upload($image, 'category/image/', null, null, 70));
        }
    }
}
