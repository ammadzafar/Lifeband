<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ExcerciseResource;
use App\Model\Api\Excercise;
use App\Model\UserAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExcerciseController extends Controller
{
    public function show(Request $request){

        try {
            $user_account = UserAccount::where('email',$request->user()->email)->first();
            $user_excercise = Excercise::where('user_account_id',$user_account->id)->orderBy('created_at','DESC')->first();
            if (!$user_excercise) return response()->json(success_response(200,'Particular user has no data to show!',['User_excercise'=>[]]));
            return response()->json(success_response(200,'Excercise Record',new ExcerciseResource($user_excercise)));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something Went Wrong '/*.$e->getMessage()*/));
        }
    }
    public function store(Request $request){
        $validate = Validator::make( $request->all(),[
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
            $user_excercise = Excercise::create([
                'user_account_id' => $user->id,
                'distance' => $request->input('distance'),
                'time' => Carbon::now(),
                'kcal_burned' => $request->input('kcal_burned'),
                'steps' => $request->input('steps'),
            ]);
            return response()->json(success_response(200,'Data Successfully inserted',new ExcerciseResource($user_excercise)));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something Went Wrong'/*.$e->getMessage()*/));
        }
    }
}



