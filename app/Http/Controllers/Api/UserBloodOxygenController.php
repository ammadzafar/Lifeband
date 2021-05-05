<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BloodOxygenResource;
use App\Model\Api\BloodOxygen;
use App\Model\UserAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserBloodOxygenController extends Controller
{
    public function showBloodOxygen(Request $request){

        try {
            $user_account = UserAccount::where('email',$request->user()->email)->first();
            $blood_oxygenQuery = BloodOxygen::query();
            $blood_oxygenQuery->where('user_account_id',$user_account->id);
            $count = 0;
            $value = 0;

            if($request->has('from') && $request->has('to')){
                $diff_Indays = Carbon::parse($request->from)->diffInDays($request->to);
                $blood_oxygen_data = [];
                for ($i = 1; $i <= $diff_Indays; $i++)
                {
                    $blood_oxygen_data[] = Carbon::parse($request->from)->addDay($i)->toDateString();
                }
                $latest_record = [];
                foreach ($blood_oxygen_data as $date){
                    $latest_record[] = BloodOxygen::where('user_account_id',$user_account->id)->whereDate('created_at',$date)->orderBy('created_at','DESC')->first();
                }
                foreach($latest_record as $key => $item){
                    if ($item){
                        $count += 1;
                        $value += $item->value;
                    }
                }
                if ($count != 0){
                    $total = round($value/$count);
                }
            }
            if ($request->has('from') && !$request->has('to')){
                $records = BloodOxygen::where('user_account_id',$user_account->id)->whereDate('created_at', '=', $request->from)->get();
                foreach($records as $record){
                    if ($record){
                        $count += 1;
                        $value += $record->value;
                    }
                }
                if ($count != 0){
                    $total = round($value/$count);
                }
            }
            if (!$request->has('from') && !$request->has('to')){
                $current_date = Carbon::now();
                $record = BloodOxygen::where('user_account_id',$user_account->id)->whereDate('created_at', '=', $current_date)->orderBy('created_at','DESC')->first();
                if ($record){
                    $count += 1;
                    $value += $record->value;

                }
                if ($count != 0){
                    $total = round($value/$count);
                }
            }
            return response()->json(success_response(200,'List Of Data',['value' =>  $total ?? 0]));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'.$e->getMessage()));
        }
    }
    public function storeBloodOxygen(Request $request){

        $validate = Validator::make($request->all(),[
            'value'=>'required',
        ]);
        if($validate->fails()){
            $response = error_response(422,'Invalid Data', $validate->errors());
            return response()->json($response);
        }
        $user = UserAccount::where('email',auth()->user()->email)->firstOrFail();
        try {
            $blood_oxygen = BloodOxygen::create([
                'value'=>$request->input('value'),
                'user_account_id'=>$user->id,
                'date_time'=>Carbon::now()->toDateTimeString(),
            ]);
            return response()->json(success_response(200,'Data Successfully inserted!',new BloodOxygenResource($blood_oxygen)));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'));
        }
    }
}
