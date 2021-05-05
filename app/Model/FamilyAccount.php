<?php

namespace App\Model;

use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;

class FamilyAccount extends Model
{
    use UuId;
    protected $guarded = ['id'];

    public function familyAccountUsers()
    {
        return $this->hasMany(UserAccount::class,'account_id','id');
    }
    public function familyGroup()
    {
        return $this->hasMany(Group::class);
    }
    public function familyQuestions(){
        return $this->hasMany(Questionnaire::class);
    }
}
