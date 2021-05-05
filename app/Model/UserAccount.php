<?php

namespace App\Model;

use App\Model\Api\BloodPressure;
use App\Model\Api\BloodOxygen;
use App\Model\Api\BodyTemperature;
use App\Model\Api\CoronaAlert;
use App\Model\Api\Excercise;
use App\Model\Api\Feedback;
use App\Model\Api\HeartRate;
use App\Model\Api\Measure;
use App\Model\Api\Pedometer;
use App\Model\Api\Running;
use App\Model\Api\Sleep;
use App\Model\Api\Step;
use App\Traits\UuId;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use UuId;
    protected $guarded = ['id'];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function familyAccounts()
    {
        return $this->belongsTo(FamilyAccount::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function heartRate(){
        return $this->hasOne(HeartRate::class);
    }

    public function bodyTemperature(){
        return $this->hasOne(BodyTemperature::class);
    }

    public function bloodOxygen(){
        return $this->hasOne(BloodOxygen::class);
    }

    public function bloodPressure(){
        return $this->hasOne(BloodPressure::class);
    }
    public function pedometer(){
        return $this->hasOne(Pedometer::class);
    }
    public function sleep(){
        return $this->hasOne(Sleep::class);
    }
    public function coronaAlert(){
        return $this->hasOne(CoronaAlert::class);
    }
    public function coronaContact(){
        return $this->hasMany(CoronaContact::class,'user_account_id');
    }
    public function Measure(){
        return $this->hasOne(Measure::class);
    }
    public function userExcercise(){
        return $this->hasOne(Excercise::class);
    }
    public function userRunning(){
        return $this->hasOne(Running::class);
    }
    public function userSteps(){
        return $this->hasOne(Step::class);
    }
    public function userFeedback(){
        return $this->hasOne(Feedback::class);
    }
    public function heartRateValue(){
        return HeartRate::orderBy('created_at','DESC')->value('value');
    }
}
