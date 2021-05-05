<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;
use App\Model\Role;
use App\Model\User;
use App\Model\UserAccount;
use App\Notifications\EmailVerificationNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){

        $validateData = Validator::make($request->all(),[
            'email'=>'email|required|unique:users',
            'password'=>'required',
        ]);
        if($validateData->fails()){
            return response()->json(error_response(422,"Invalid Data", $validateData->errors()));
        }
        try {
            $role = Role::where('name','individual')->first();
            $user = User::create([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password'=>bcrypt($request->input('password')),
                'role_id'=>$role->id,
                'email_verified_at'=>Carbon::now(),
            ]);
            $user_verification = User::where('email',$user->email)->firstOrFail();
            $user->notify(new EmailVerificationNotification($user_verification));

            $token = $user->createToken('authToken')->accessToken;
            UserAccount::create([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password'=>bcrypt($request->input('password')),
                'account_type'=>$role->name,
            ]);
            return response()->json(success_response(200,'User successfully registered',new RegisterResource([$user,$token])));
        }catch(\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'.$e->getMessage()));
        }
    }
    public function login(Request $request){

//        $validateData = Validator::make($request->all(),[
//            'email'=>'email|required',
//            'password'=>'required',
//        ]);
//        if($validateData->fails()){
//            return response()->json(error_response(422,"Invalid Data", $validateData->errors()));
//        }


        $loginData = $request->validate([
            'email'=>'email|required',
            'password'=>'required',
        ]);

        if (!auth()->attempt($loginData)){
            return response()->json(error_response(422,"Invalid Credentials"));
        }

        $token = auth()->user()->createToken('authToken')->accessToken;

        if (auth()->user()->email_verified_at != Null){
            return response()->json(success_response(200,'Successfully Login',new LoginResource([auth()->user(),$token])));
        }
        return response()->json(error_response(500,'You need to verify your Email First!'));
    }

    public function socialLogin(Request $request)
    {
        try {
            $user = User::where('provider_id',$request->provider_id)->first();
            if ($user){
                $token = $user->createToken('authToken')->accessToken;
            }else{
                $role = Role::where('name','individual')->first();
                $body = $request->all();
                $body['role_id'] = $role->id;
                $user = User::create($body);

                $token = $user->createToken('authToken')->accessToken;
                $data = $request->all();
                $data['account_type'] = 'individual';
                UserAccount::create($data);
            }
            return response()->json(success_response(200,'User successfully registered',new RegisterResource([$user,$token])));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong! '.$e->getMessage()));
        }
    }
}
