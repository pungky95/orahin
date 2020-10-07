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

class Category extends Model
{
    use SoftDeletes, MediaHandling;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

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
    protected $fillable = ['name', 'image', 'status'];

    /**
     * @param $category
     * @return array|string
     * @throws Throwable
     */
    public static function laratablesCustomAction($category)
    {
        return view('dashboard.category.action', compact('category'))->render();
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
     * @return HasMany
     */
    public function subcategories()
    {
        return $this->hasMany('App\Models\Subcategory', 'category_id', 'id');
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
