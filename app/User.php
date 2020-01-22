<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function permissions()
    {
        return $this->hasMany('\App\UserPermission');
    }

    public function able($slug){
        $user_perm = \App\UserPermission::where(['user_id' => auth()->user()->id, 'permission_id' => $slug])->first();
        if (isset($user_perm)) {
            return true;
        }else{
            return false;
        }
    }
}
