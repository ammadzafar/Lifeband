<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\HeartRateResource;
use App\Model\Api\HeartRate;
use App\Model\UserAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserHeartRateController extends Controller
{
    public function showHeartRate(Request $request){

        try {
            $user_account = UserAccount::where('email',$request->user()->email)->first();
            $heart_rateQuery = HeartRate::query();
            $heart_rateQuery->where('user_account_id',$user_account->id);
            $count = 0;
            $value = 0;
            $normal_count = 0;
            $high_count = 0;

            if($request->has('from') && $request->has('to')){
                $diff_Indays = Carbon::parse($request->from)->diffInDays($request->to);
                $heart_rate_data = [];
                for ($i = 1; $i <= $diff_Indays; $i++)
                {
                   $heart_rate_data[] = Carbon::parse($request->from)->addDay($i)->toDateString();
                }
                $latest_record = [];
                foreach ($heart_rate_data as $date){
                    $latest_record[] = HeartRate::where('user_account_id',$user_account->id)->whereDate('created_at',$date)->orderBy('created_at','DESC')->first();
                }

                foreach($latest_record as $key => $item){
                    if ($item){
                        $count += 1;
                        $value += $item->value;

                        if ($item->value >= 60 && $item->value <= 90 ){
                            $normal_count += 1;
                        }else{
                            $high_count += 1;
                        }
                    }
                }
                if ($count!=0){
                    $total = round($value/$count);
                }
            }
            if ($request->has('from') && !$request->has('to')){
                $records = HeartRate::where('user_account_id',$user_account->id)->whereDate('created_at', '=', $request->from)->get();
                foreach ($records as $record){
                    if ($record){
                        $count += 1;
                        $value += $record->value;

                        if ($record->value >= 60 && $record->value <= 90 ){
                            $normal_count += 1;
                        }else{
                            $high_count += 1;
                        }
                    }
                }

                if ($count!=0){
                    $total = round($value/$count);
                }
            }
            if (!$request->has('from') && !$request->has('to')){
                $current_date = Carbon::now();
                $record = HeartRate::where('user_account_id',$user_account->id)->whereDate('created_at', '=', $current_date)->orderBy('created_at','DESC')->first();
                if ($record){
                    $count += 1;
                    $value += $record->value;

                    if ($record->value >= 60 && $record->value <= 90 ){
                        $normal_count += 1;
                    }else{
                        $high_count += 1;
                    }
                }
                if ($count!=0){
                    $total = round($value/$count);
                }
            }
            return response()->json(success_response(200,'List Of Data',['value' => $total ?? 0,'normal_count'=>$normal_count,'abnormal_count'=>$high_count]));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'/*.$e->getMessage()*/));
        }
    }
    public function storeHeartRate(Request $request){

        $validate =Validator::make($request->all(),[
            'value'=>'required',
        ]);
        if($validate->fails()){
            $response = error_response(422,"Invalid Data", $validate->errors());
            return response()->json($response);
        }
        $user = UserAccount::where('email',auth()->user()->email)->firstOrFail();
        try {
            $heart_rate = HeartRate::create([
                'value'=>$request->input('value'),
                'user_account_id'=>$user->id,
                'date_time'=>Carbon::now()->toDateTimeString(),
            ]);
            return response()->json(success_response(200,'Data Successfully inserted!',new HeartRateResource($heart_rate)));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'/*.$e->getMessage()*/));
        }
    }
}
