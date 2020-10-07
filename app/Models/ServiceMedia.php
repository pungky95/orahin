<?php

namespace App\Models;

use App\Traits\MediaHandling;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ServiceMedia extends Model
{
    use MediaHandling;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_medias';

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
    protected $fillable = ['service_id', 'image', 'order'];

    /**
     * @param $image
     */
    public function setImageAttribute($image)
    {
        $this->attributes['image'] = $image;
        if (filter_var($image, FILTER_VALIDATE_URL) === FALSE) {
            $this->attributes['image'] =
                Storage::url($this->upload($image, 'service/media/', null, null, 70));
        }

    }

}
