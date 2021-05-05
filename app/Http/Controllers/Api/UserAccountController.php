<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserAccountResource;
use App\Model\User;
use App\Model\UserAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserAccountController extends Controller
{
    public function show(){
        try {
            $user = UserAccount::where('email',auth()->user()->email)->first();
            if (!$user) return response()->json(success_response(200,'Particular user has no data to show!',['User Info'=>[]]));
            return response()->json(success_response(200,'User Info',new UserAccountResource($user)));
        }catch(\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'/*.$e->getMessage()*/));
        }
    }

    public function store(Request $request)
    {
        $validate = Validator::make( $request->all(),[
//            'image'=>'mimes:jpeg,jpg,png|required',
//            'age'=>'required',
//            'gender'=>'required',
//            'height'=>'required',
//            'height_unit'=>'required',
//            'weight'=>'required',
//            'weight_unit'=>'required',
//            'step_length'=>'required',
//            'step_length_unit'=>'required',
//            'wear_side'=>'required',
//            'personal_goal'=>'required',
        ]);
        if($validate->fails()){
            $response = error_response(422,"Invalid Data" ,$validate->errors());
            return response()->json($response);
        }

        try {
            $filename = null;
            if ($request->hasFile('image')){
                $filename = time().'_'.$request->file('image')->getClientOriginalName();
                $request->file('image')->move('uploads/api/images',$filename);
            }

            $request_all = $request->all();

            if ($request->has('image')){
                $request_all['image'] = $filename;
            }

            UserAccount::where('email',Auth::user()->email)->update($request_all);
            $user_account = UserAccount::where('email',Auth::user()->email)->first();

            $user = User::where('email',Auth::user()->email)->first();
            $user->name = $user_account->name;
            $user->image = $request_all['image'] ?? $user->image;
            $user->save();
            return response()->json(success_response(200,'Data Successfully Created!',new UserAccountResource($user_account)));
        }
        catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'.$e->getMessage()));
        }
    }


                           /*===================================================================================================================== */


    public function edit(){
        try {
            $user = UserAccount::where('email',auth()->user()->email)->first();
            return response()->json(success_response(200,'User Info',new UserAccountResource($user)));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'));
        }
    }
    public function update(Request $request){

        $validate = Validator::make( $request->all(),[
//            'name'=>'required|max:20',
//            'image'=>'mimes:jpeg,jpg,png|required',
//            'age'=>'required',
//            'gender'=>'required',
//            'height'=>'required',
//            'height_unit'=>'required',
//            'weight'=>'required',
//            'weight_unit'=>'required',
//            'step_length'=>'required',
//            'step_length_unit'=>'required',
//            'wear_side'=>'required',
//            'personal_goal'=>'required',
        ]);
        if($validate->fails()){
            $response = error_response(422,'Invalid Data', $validate->errors());
            return response()->json($response);
        }

        try {
            $filename = null;
            if ($request->hasFile('image')){
                $filename =  time().'_'.$request->file('image')->getClientOriginalName();
                $request->file('image')->move('uploads/api/images',$filename);
            }
            $user = User::find($request->user()->id);
            $user_account = UserAccount::where('email',$user->email)->first();
            $update_account = UserAccount::find($user_account->id);

            $update_account->update([
                'name' => $request->input('name'),
                'image' => $filename,
                'age' => $request->input('age'),
                'gender' => $request->input('gender'),
                'height' => $request->input('height'),
                'height_unit' => $request->input('height_unit'),
                'weight' => $request->input('weight'),
                'weight_unit' => $request->input('weight_unit'),
                'step_length' => $request->input('step_length'),
                'step_length_unit' => $request->input('step_length_unit'),
                'wear_side' => $request->input('wear_side'),
                'personal_goal' => $request->input('personal_goal'),
            ]);
            Auth::user()->update([
                'name'=> $update_account->name,
                'email' => $update_account->email,
                'password' => $update_account->password,
            ]);
            return response()->json(success_response(200,'Data Successfully Updated!',new UserAccountResource($update_account)));
        }
        catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'/*.$e->getMessage()*/));
        }
    }
}
