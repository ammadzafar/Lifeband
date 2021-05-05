<?php

namespace App\Http\Controllers\Api;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function show(Request $request){

        $validateData = Validator::make($request->all(),[
            'old_password' => 'required',
            'new_password' => 'required',
        ]);
        if($validateData->fails()){
            return response()->json(error_response(422,"Invalid Data", $validateData->errors()));
        }
        try {
            $user = User::where('email', auth()->user()->email)->first();
            if (!Hash::check($request->old_password,$user->password)){
                return response()->json(error_response(500,"Old-password doesn't match"));
            }
            $user->password = Hash::make($request->new_password);
            $user->save();
            return response()->json(success_response(200,'Password Successfully Changed'));
        }catch(\Exception $e){
            return response()->json(error_response(404,'Something Went Wrong! '.$e->getMessage()));
        }
    }
}
