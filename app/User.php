<?php

namespace App;

use Auth;
use Cache;
use Hootlex\Friendships\Models\Friendship;
use Hootlex\Friendships\Traits\Friendable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Trait
    public function isOnline()
    {
        if (Cache::has('user-is-online-' . $this->id)) {
            return 'online';
        } else {
            return 'offline';
        }
    }

    public function isFriend($id)
    {
        $authUser = Auth::user();

        $friends = $authUser->getFriends();

        return in_array($id, $friends->toArray());
    }
}
