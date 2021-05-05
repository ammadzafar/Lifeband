<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BandAddressResource;
use App\Model\UserAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BandAddressController extends Controller
{
    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'band_address'=>'required',
        ]);
        if($validate->fails()){
            $response = error_response(422,"Invalid Data", $validate->errors());
            return response()->json($response);
        }
        try {
            $user = UserAccount::where('email',auth()->user()->email)->firstOrFail();
            $user->band_address = $request->band_address;
            $user->save();
            return response()->json(success_response(200,'Data Successfully inserted!',new BandAddressResource($user)));
        }catch(\Exception $e){
            return response()->json(error_response(500,'something went wrong!'));
        }
    }
}
