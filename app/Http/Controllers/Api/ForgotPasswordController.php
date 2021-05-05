<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ResetPasswordResource;
use App\Http\Resources\ResetPasswordTokenResource;
use App\Notifications\PasswordResetNotification;
use App\Notifications\PasswordResetSuccess;
use App\Model\PasswordReset;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function sendResetEmail(Request $request){

            $validateData = Validator::make($request->all(),[
                'email' => 'email|required|string|email',
            ]);
            if($validateData->fails()){
                return response()->json(error_response(422,"Invalid Data", $validateData->errors()));
            }

            try {
                $user = User::where('email',$request->email)->first();

                if (!$user)
                    return response()->json(error_response(404,'We cant find a user with that e-mail address'));
                $passwordReset = PasswordReset::create(
                    [
                        'email' => $user->email,
                        'api_token' => rand(00000,99999)
                    ]
                );
                if ($user && $passwordReset)
                    $user->notify(new PasswordResetNotification($passwordReset));
                return response()->json(success_response(200, 'We have e-mailed your password reset link!'));
            }catch(\Exception $e){
                return response()->json(error_response(404,'Something Went Wrong.'));
            }
    }
    public function findToken(Request $request){

        $passwordReset = PasswordReset::where('api_token',$request->token)->first();
        if (!$passwordReset)
            return response()->json(error_response(500,'This password reset token is invalid'));
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()){
            $passwordReset->delete();
            return response()->json(error_response(500,'This password reset token is invalid'));
        }
        return response()->json(success_response(200,'Reset token Successfully Matched!',new ResetPasswordTokenResource($passwordReset)));
    }

    public function resetPassword(Request $request){

        $validateData = Validator::make($request->all(),[
            'email' => 'email|required|string|email',
            'password' => 'required|string',
            'token' => 'required|string'
        ]);
        if($validateData->fails()){
            return response()->json(error_response(422,"Invalid Data", $validateData->errors()));
        }
        try {
            $passwordReset = PasswordReset::where([
            ['api_token', $request->token],
                ['email', $request->email]
            ])->first();

        if (!$passwordReset)
            return response()->json(error_response(500,'This password reset token is invalid'));

            $user = User::where('email', $request->email)->first();

            if (!$user)
                return response()->json(error_response(500,'We cant find a user with that email address'));

            $user->password = bcrypt($request->password);
            $user->save();
            if ($passwordReset){
                $passwordReset->delete();
            }
            $user->notify(new PasswordResetSuccess($passwordReset));
            return response()->json(success_response(200,'Password Successfully Changed!',new ResetPasswordResource($user)));
        }catch (\Exception $e){
            return response()->json(error_response(404,'Something Went Wrong! '/*.$e->getMessage()*/));
        }






//        $request->validate([
//            'email' => 'email|required|string|email',
//            'password' => 'required|string',
////            'token' => 'required|string'
//        ]);
//
//        $passwordReset = PasswordReset::where([
////            ['api_token', $request->token],
//            ['email', $request->email]
//        ])->first();
////        if (!$passwordReset)
////            return response()->json(error_response(500,'This password reset token is invalid'));
//
//        $user = User::where('email', $passwordReset->email)->first();
//
//        if (!$user)
//            return response()->json(error_response(500,'We cant find a user with that email address'));
//
//        $user->password = bcrypt($request->password);
//        $user->save();
//        $passwordReset->delete();
//
//        $user->notify(new PasswordResetSuccess($passwordReset));
//        return response()->json(success_response(200,'Password Successfully Changed!',new ResetPasswordResource($user)));
    }
}
