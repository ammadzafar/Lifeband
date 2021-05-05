<?php

namespace App\Model;

use App\Traits\UuId;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,UuId,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function isAdmin()
    {
        $data = Role::where('name',Role::$ADMIN)->first()->id;
        return auth()->user()->role_id == $data;
    }
    public function isOrganizer()
    {
        $data = Role::where('name',Role::$ORGANIZATION)->first()->id;
        return auth()->user()->role_id == $data;
    }
    public function isFamilyAccountant()
    {
        $data = Role::where('name',Role::$FAMILY)->first()->id;
        return auth()->user()->role_id == $data;
    }
    public function isIndividualAccountant()
    {
        $data = Role::where('name',Role::$INDIVIDUAL)->first()->id;
        return auth()->user()->role_id == $data;
    }
    public function getRole()
    {
        return auth()->user()->role->name;
    }
}
