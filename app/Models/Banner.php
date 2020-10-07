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
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use SoftDeletes, MediaHandling;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banners';

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
    protected $fillable = ['name', 'image', 'start_date', 'end_date', 'description', 'link', 'status'];

    /**
     * @param $banner
     * @return array|string
     * @throws \Throwable
     */
    public static function laratablesCustomAction($banner)
    {
        return view('dashboard.banner.action', compact('banner'))->render();
    }

    /**
     * get the bulletin's start date.
     *
     * @return string
     */
    public function getStartDateAttribute($value)
    {
        return Carbon::parse($value)->format('j F Y');
    }

    /**
     * get the bulletin's end date.
     *
     * @return string
     */
    public function getEndDateAttribute($value)
    {
        return Carbon::parse($value)->format('j F Y');
    }

    /**
     * get the bulletin's start date and end date.
     *
     * @return string
     */
    public function getActiveDateAttribute()
    {
        $startDate = Carbon::parse($this->start_date)->format('m/d/Y');
        $endDate = Carbon::parse($this->end_date)->format('m/d/Y');
        return "{$startDate} / {$endDate}";
    }

    /**
     * @param $image
     */
    public function setImageAttribute($image)
    {
        $this->attributes['image'] = $image;
        if (filter_var($image, FILTER_VALIDATE_URL) === FALSE) {
            $this->attributes['image'] = Storage::url($this->upload($image, 'banner/image/', null, null, 70));
        }
    }
}
