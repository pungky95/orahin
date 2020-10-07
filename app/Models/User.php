<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

namespace App\Models;

use App\Traits\MediaHandling;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Throwable;

class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes, MediaHandling;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Generate action dropdown
     * @param $user
     * @return array|string
     * @throws Throwable
     */
    public static function laratablesCustomAction($user)
    {
        return view('dashboard.user.action', ['user' => $user])->render();
    }

    /**
     * Adds the condition for searching the name of the user in the query.
     *
     * @param Builder
     * @param string search term
     * @return Builder
     */
    public static function laratablesSearchName($query, $searchValue)
    {
        return $query->orWhere('users.name', 'like', '%' . $searchValue . '%');
    }

    /**
     * Adds the condition for searching the name of the user in the query.
     *
     * @param Builder
     * @param string search term
     * @return Builder
     */
    public static function laratablesSearchRole($query, $searchValue)
    {
        return $query->orWhere('r.name', 'like', '%' . $searchValue . '%');
    }

    /**
     * @param $avatar
     */
    public function setAvatarAttribute($avatar)
    {
        $this->attributes['avatar'] = $avatar;
        if (filter_var($avatar, FILTER_VALIDATE_URL) === FALSE) {
            $this->attributes['avatar'] = $this->upload($avatar, 'user/avatar/', 500, 500);
        }
    }

    /**
     * get the users's avatar.
     *
     * @return string
     */
    public
    function getAvatarUrlAttribute()
    {
        if (Storage::exists($this->avatar)) {
            return Storage::url($this->avatar);
        } else {
            return $this->avatar;
        }
    }
}
