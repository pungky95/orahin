<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'villages';

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
    protected $fillable = ['district_id', 'name'];

    /**
     * Get the village's name.
     *
     * @param string $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District', 'district_id', 'id');
    }
}
