<?php

namespace App\Http\Controllers\Api;

use App\Model\Api\BloodOxygen;
use App\Model\Api\BloodPressure;
use App\Model\Api\BodyTemperature;
use App\Model\Api\CoronaAlert;
use App\Model\Api\Excercise;
use App\Model\Api\HeartRate;
use App\Model\Api\Pedometer;
use App\Model\Api\Running;
use App\Model\Api\Sleep;
use App\Model\UserAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResetDataController extends Controller
{
    public function resetData(Request $request){

        try {
            $user_account = UserAccount::where('email',$request->user()->email)->first();
                BloodOxygen::where('user_account_id',$user_account->id)->delete();
                BloodPressure::where('user_account_id',$user_account->id)->delete();
                Sleep::where('user_account_id',$user_account->id)->delete();
                HeartRate::where('user_account_id',$user_account->id)->delete();
                CoronaAlert::where('user_account_id',$user_account->id)->delete();
                BodyTemperature::where('user_account_id',$user_account->id)->delete();
                Pedometer::where('user_account_id',$user_account->id)->delete();
                Excercise::where('user_account_id',$user_account->id)->delete();
                Running::where('user_account_id',$user_account->id)->delete();

            return response()->json(success_response(200,'Data successfully deleted'));
        }catch (\Exception $e) {
            return response()->json(error_response(500,'Something went Wrong!'/*.$e->getMessage()*/));
        }
    }
}
