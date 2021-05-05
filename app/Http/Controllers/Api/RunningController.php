<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\RunningResource;
use App\Model\Api\Running;
use App\Model\UserAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RunningController extends Controller
{
    public function show(){
        try {
            $user = UserAccount::where('email',auth()->user()->email)->firstorfail();
            $user_running = Running::where('user_account_id',$user->id)->orderBy('created_at','DESC')->first();
            if($user_running) {
                return response()->json(success_response(200,'User Running Data',new RunningResource($user_running)));
            }
            return response()->json(success_response(200,'Particular user has no data to show!',['User_running'=>[]]));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something Went Wrong!' /*.$e->getMessage()*/));
        }
    }
    public function store(Request $request){
        $validate = Validator::make($request->all(),[
                'minutes_per_km' => 'required',
                'time' => 'required',
                'distance' => 'required',
                'kcal_burned' => 'required',
                'steps' => 'required',
            ]);
        if($validate->fails()){
            $response = error_response(422,"Invalid Data", $validate->errors());
            return response()->json($response);
        }
        try {
            $user = UserAccount::where('email',auth()->user()->email)->firstOrFail();
            $user_running = Running::create([
                'user_account_id' => $user->id,
                'minutes_per_km' => $request->input('minutes_per_km'),
                'time' => $request->input('time'),
                'distance' => $request->input('distance'),
                'kcal_burned' => $request->input('kcal_burned'),
                'steps' => $request->input('steps'),
            ]);
            return response()->json(success_response(200,'Data Successfully inserted!',new RunningResource($user_running)));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something Went Wrong!'/*.$e->getMessage()*/));
        }
    }
}



