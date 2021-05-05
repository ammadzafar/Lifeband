<?php

namespace App\Model\Api;

use App\Model\UserAccount;
use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodPressure extends Model
{
    use UuId,SoftDeletes;
    protected $guarded = ['id'];
    protected $hidden = ['id','user_account_id','created_at','updated_at','deleted_at','show'];

    public function userBloodPressure(){
        return $this->belongsTo(UserAccount::class);
    }
//    public function bloodPressureMeasure(){
//        return $this->belongsTo(Measure::class);
//    }
}
