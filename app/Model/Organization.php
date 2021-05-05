<?php

namespace App\Model;

use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use UuId;
    protected $guarded = ['id'];

    public function organizationUsers()
    {
        return $this->hasMany(UserAccount::class,'account_id','id');
    }
    public function organizationGroup()
    {
        return $this->hasMany(Group::class);
    }
    public function orgQuestions(){
        return $this->hasMany(Questionnaire::class);
    }
}
