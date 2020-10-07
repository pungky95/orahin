<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Throwable;

class Bulletin extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bulletins';

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
    protected $fillable = ['company_id', 'job_name', 'description', 'salary', 'time_period', 'start_date', 'end_date'];

    /**
     * @param $bulletin
     * @return array|string
     * @throws Throwable
     */
    public static function laratablesCustomAction($bulletin)
    {
        return view('dashboard.bulletin.action', compact('bulletin'))->render();
    }

    /**
     * Set the bulletin's salary.
     *
     * @param string $value
     * @return void
     */
    public function setSalaryAttribute($value)
    {
        $this->attributes['salary'] = convertToNumber($value);
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
     * get the bulletin's end date.
     *
     * @return string
     */
    public function getSalaryAttribute($value)
    {
        return formatCurrency($value);
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

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
