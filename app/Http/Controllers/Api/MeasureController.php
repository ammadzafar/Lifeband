<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\MeasureResource;
use App\Model\Api\Measure;
use App\Model\UserAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MeasureController extends Controller
{
    public function show(Request $request){
        try {
            $user_account = UserAccount::where('email',$request->user()->email)->first();
            $measure = Measure::where('user_account_id',$user_account->id)->orderBy('created_at','DESC')->first();
            if ($measure){
                return response()->json(success_response(200,'List Of Data',['heart_rate' => $measure->heart_rate,
                    'blood_pressure'=>['low_value'=>$measure->blood_pressure_low,'high_value'=>$measure->blood_pressure_high],
                    'blood_oxygen' => $measure->blood_oxygen]));
            }
            return response()->json(success_response(200,'Particular user has no data to show!',['record'=>[]]));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong! '.$e->getMessage()));
        }
    }

    public function store(Request $request){

        $validate = Validator::make( $request->all(),[
            'heart_rate'=>'required',
            'blood_pressure_high'=>'required',
            'blood_pressure_low'=>'required',
            'blood_oxygen'=>'required',

        ]);
        if($validate->fails()){
            $response = error_response(422,"Invalid Data" ,$validate->errors());
            return response()->json($response);
        }
        try {
            $user = UserAccount::where('email',auth()->user()->email)->firstOrFail();
            $user_measure = Measure::create([
                'user_account_id' => $user->id,
                'heart_rate' => $request->input('heart_rate'),
                'blood_pressure_high' => $request->input('blood_pressure_high'),
                'blood_pressure_low' => $request->input('blood_pressure_low'),
                'blood_oxygen' => $request->input('blood_oxygen'),
            ]);
            return response()->json(success_response(200,'Data Successfully inserted',new MeasureResource($user_measure)));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something Went Wrong'.$e->getMessage()));
        }
    }
}
