<?php

namespace App\Model\Api;

use App\Model\UserAccount;
use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoronaAlert extends Model
{
    use UuId,SoftDeletes;
    protected $guarded = ['id'];

    public function userCoronaAlert(){
        return $this->belongsTo(UserAccount::class);
    }
}
