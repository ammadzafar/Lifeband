<?php

namespace App\Model\Api;

use App\Model\UserAccount;
use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BodyTemperature extends Model
{
    use UuId,SoftDeletes;
    protected $guarded = ['id'];
    protected $hidden = ['id','user_account_id','created_at','updated_at','deleted_at','show'];

    public function userBodyTemperature(){
        return $this->belongsTo(UserAccount::class);
    }
}
