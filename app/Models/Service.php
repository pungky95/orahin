<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'services';

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
    protected $fillable = ['vendor_id', 'name', 'description', 'price', 'unit', 'quantity', 'status'];

    public function serviceMedias()
    {
        return $this->hasMany('App\Models\ServiceMedia', 'service_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'service_category', 'service_id', 'category_id');
    }

    public function subcategories()
    {
        return $this->belongsToMany('App\Models\Subcategory', 'service_subcategory', 'service_id', 'subcategory_id');
    }

    public function favoriteItems()
    {
        return $this->belongsToMany('App\Models\Customer', 'favorite_items', 'service_id', 'customer_uid')->withPivot('created_at');
    }
}
