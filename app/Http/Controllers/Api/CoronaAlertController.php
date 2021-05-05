<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CoronaAlertResource;
use App\Model\Api\CoronaAlert;
use App\Model\CoronaContact;
use App\Model\UserAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CoronaAlertController extends Controller
{
    public function show(Request $request){

        try {
            $user_account = UserAccount::where('email',$request->user()->email)->first();

            $coronaQuery = count(CoronaContact::where('user_account_id',$user_account->id)->where('contact_type','high')->get());
            if ($coronaQuery){
                return response()->json(success_response(200,'List Of Data',
                    ['total_breaches' => $coronaQuery ]));
            }
             return response()->json(success_response(200,'Particular user has no data to show!',['total_breaches'=>[]]));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'));
        }
    }
    public function store(Request $request){

//        $validate = Validator::make($request->all(),[
////            'safe'=>'required',
//            'safe*'=>'/*required|*/string|distinct',
////            'medium'=>'required',
//            'medium*'=>'/*required|*/string|distinct',
////            'high'=>'required',
//            'high*'=>'/*required|*/string|distinct',
//        ]);
//        if($validate->fails()){
//            $response = error_response(422,"Invalid Data", $validate->errors());
//            return response()->json($response);
//        }

        try {
//            dd($request->safe);
            $safe_array = explode(',',$request->safe);
            $medium_array = explode(',',$request->medium);
            $high_array = explode(',',$request->high);

            $user = UserAccount::where('email',auth()->user()->email)->firstOrFail();

                if ($request->safe != null){
                    foreach($safe_array as $safe){
                        $corona_contact = new CoronaContact();
                        $corona_contact->user_account_id = $user->id;
                        $corona_contact->trigger_time = Carbon::now();
                        $corona_contact->contact_person_bluetooth_address = $safe;
                        $corona_contact->contact_type = 'safe';
                        $corona_contact->save();
                        CoronaAlert::create([
                            'user_account_id'=>$user->id,
                            'trigger_time'=>Carbon::now(),
                        ]);
                    }
                }

                if ($request->medium != null){
                    foreach($medium_array as $medium){
                        $corona_contact = new CoronaContact();
                        $corona_contact->user_account_id = $user->id;
                        $corona_contact->trigger_time = Carbon::now();
                        $corona_contact->contact_person_bluetooth_address = $medium;
                        $corona_contact->contact_type = 'medium';
                        $corona_contact->save();
                        CoronaAlert::create([
                            'user_account_id'=>$user->id,
                            'trigger_time'=>Carbon::now(),
                        ]);
                    }
                }

               if ($request->high != null){
                   foreach($high_array as $high){
                       $corona_contact = new CoronaContact();
                       $corona_contact->user_account_id = $user->id;
                       $corona_contact->trigger_time = Carbon::now();
                       $corona_contact->contact_person_bluetooth_address = $high;
                       $corona_contact->contact_type = 'high';
                       $corona_contact->save();
                       CoronaAlert::create([
                           'user_account_id'=>$user->id,
                           'trigger_time'=>Carbon::now(),
                       ]);
                   }
               }
            return response()->json(success_response(200,'Data Successfully inserted!'/*,new CoronaAlertResource($corona_contact)*/));
        }catch (\Exception $e){
            return response()->json(error_response(500,'something went wrong!'.$e->getMessage()));
        }
    }
}
