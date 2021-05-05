<?php

namespace App\Model\Api;

use App\Model\UserAccount;
use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedometer extends Model
{
    use UuId,SoftDeletes;
    protected $guarded = ['id'];
    protected $hidden = ['id','user_account_id','updated_at','created_at','deleted_at','show'];

    public function userPedometer(){
        return $this->belongsTo(UserAccount::class);
    }
}
