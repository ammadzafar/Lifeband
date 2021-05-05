<?php

namespace App\Http\Controllers\Api;

use App\Model\Api\BloodOxygen;
use App\Model\Api\BloodPressure;
use App\Model\Api\HeartRate;
use App\Model\UserAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function permission(Request $request) {

        try {
            $user_account = UserAccount::where('email',$request->user()->email)->first();
            UserAccount::where('id',$user_account->id)->update(['weight_show' => isset($request->weight)? true : null]);
            UserAccount::where('id',$user_account->id)->update(['height_show' => isset($request->height)? true : null]);
            UserAccount::where('id',$user_account->id)->update(['age_show' => isset($request->age)? true : null]);
            UserAccount::where('id',$user_account->id)->update(['gender_show' => isset($request->gender)? true : null]);
            BloodOxygen::where('user_account_id',$user_account->id)->update(['show' => isset($request->blood_oxygen)? true : null]);
            BloodPressure::where('user_account_id',$user_account->id)->update(['show' => isset($request->blood_pressure)? true : null]);
            HeartRate::where('user_account_id',$user_account->id)->update(['show' => isset($request->heart_rate)? true : null]);

            return response()->json(success_response(200,'Successfully Submit!'));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'));
        }

    }
}
