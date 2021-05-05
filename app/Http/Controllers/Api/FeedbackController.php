<?php

namespace App\Http\Controllers\Api;

use App\Model\Api\Feedback;
use App\Model\UserAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function store(Request $request){

        $validate = Validator::make($request->all(),[
           'type'=>'required',
           'feedback'=>'required',
        ]);
        if($validate->fails()){
            $response = error_response(422,"Invalid Data", $validate->errors());
            return response()->json($response);
        }
        try {
            $user = UserAccount::where('email',auth()->user()->email)->firstOrFail();
            $feedback = Feedback::create([
                'user_account_id' => $user->id,
                'type' => $request->input('type'),
                'feedback' => $request->input('feedback'),
            ]);
            return response()->json(success_response(200,'Feedback Successfully inserted!',$feedback));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'));
        }
    }
}
