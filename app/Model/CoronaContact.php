<?php

namespace App\Model;

use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;

class CoronaContact extends Model
{
    use UuId;
    protected $guarded = ['id'];

    public function userCoronaAlert(){
        return $this->belongsTo(UserAccount::class);
    }
}
