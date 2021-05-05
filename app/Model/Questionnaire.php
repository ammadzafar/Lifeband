<?php

namespace App\Model;

use App\Model\Api\QuestionnaireAnswer;
use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use UuId;
    protected $guarded = ['id'];

    public function options()
    {
        return $this->hasMany(Option::class,'question_id');
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function family()
    {
        return $this->belongsTo(FamilyAccount::class);
    }
    public function questionAnswer()
    {
        return $this->hasOne(QuestionnaireAnswer::class);
    }
}
