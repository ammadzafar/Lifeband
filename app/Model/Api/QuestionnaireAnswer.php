<?php

namespace App\Model\Api;

use App\Model\Questionnaire;
use App\Model\User;
use App\Model\UserAccount;
use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionnaireAnswer extends Model
{
    use UuId,SoftDeletes;
    protected $guarded = ['id'];

    public function answer(){
        return $this->belongsTo(Questionnaire::class,'questionnaire_id');
    }
    public function userQuestion(){
        return $this->belongsTo(UserAccount::class,'user_account_id');
    }
    public function questions(){
        return $this->belongsTo(Questionnaire::class,'questionnaire_id');
    }
}
