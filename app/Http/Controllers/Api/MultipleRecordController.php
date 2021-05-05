<?php

namespace App\Http\Controllers\Api;

use App\Model\Api\Excercise;
use App\Model\Api\Measure;
use App\Model\Api\Running;
use App\Model\UserAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MultipleRecordController extends Controller
{
    public function show(Request $request){
        try {
            $user_account = UserAccount::where('email',$request->user()->email)->first();
            $excercise = Excercise::where('user_account_id',$user_account->id)->orderBy('created_at','DESC')->first();
            $running = Running::where('user_account_id',$user_account->id)->orderBy('created_at','DESC')->first();
            $measure = Measure::where('user_account_id',$user_account->id)->orderBy('created_at','DESC')->first();

            return response()->json(success_response(200,'List Of Data',
                ['Measure'=>['heart_rate' => $measure->heart_rate ?? 0,
                    'blood_pressure'=>['low_value'=>$measure->blood_pressure_low ?? 0,'high_value'=>$measure->blood_pressure_high ?? 0],
                    'blood_oxygen' => $measure->blood_oxygen ?? 0],'Excercise'=>['kcal_burned'=>$excercise->kcal_burned ?? 0,'distance'=>$excercise->distance ?? 0],
                    'Running'=>['kcal_burned'=>$running->kcal_burned ?? 0,'distance'=>$running->distance ?? 0]]));
        }catch(\Exception $e){
            return response()->json(error_response(500,'Something went wrong! '.$e->getMessage()));
        }
    }
}
