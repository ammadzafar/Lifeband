<?php

namespace App\Http\Controllers\Api;

use App\Model\User;
use App\Notifications\EmailVerificationNotification;
use App\Services\Api\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class VerificationController extends Controller
{
    public function sendEmail(Request $request){
        $validateData = Validator::make($request->all(),[
            'email'=>'email|required',
        ]);
        if($validateData->fails()){
            return response()->json(error_response(422,"Invalid Data", $validateData->errors()));
        }
        try{
            $user = User::where('email',$request->email)->firstOrFail();
            if (isset($user)){
                if ($user->email_verified_at != Null) {
                    return response(error_response(404, 'Email Already Verified'));
                }
                $user->notify(new EmailVerificationNotification($user));
                if ($request->wantsJson()){
                    return response()->json(success_response(200, 'We have sent you verification Email!'));
                }
            }
        }catch(\Exception $e){
            if (get_class($e) == 'Illuminate\Database\Eloquent\ModelNotFoundException'){
                return response()->json(error_response(404,'It looks this email is not registered yet either provide with the authentic email or register first!'));
            }
            return response()->json(error_response(404,'Something Went Wrong.'));
        }
    }
    public function verify($email){

        try {
            $user = User::where('email',$email)->first();
            if (! $user) {
                return response()->json(error_response(404,'No Such User Exist'));
            }
            if ($user->email_verified_at != Null) {

                return response()->json(success_response(200,'Email Already Verified'));
            }
            $user->email_verified_at = Carbon::now()->toDateTimeString();
            $user->save();
            return response()->json(success_response(200,'You have Successfully Verified your email address!'));
        }catch (\Exception $e){
            return response()->json(error_response(404,'Something Went Wrong.'));
        }

    }
}
