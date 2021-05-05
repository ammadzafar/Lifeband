<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BloodPressureResource;
use App\Model\Api\BloodPressure;
use App\Model\UserAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BloodPressureController extends Controller
{
    public function show(Request $request){

        try {
            $user_account = UserAccount::where('email',$request->user()->email)->first();
            $blood_pressureQuery = BloodPressure::query();
            $blood_pressureQuery->where('user_account_id',$user_account->id);
            $count = 0;
            $low_value = 0;
            $high_value = 0;
            $normal_count = 0;
            $high_count = 0;

            if($request->has('from') && $request->has('to')){
                $diff_Indays = Carbon::parse($request->from)->diffInDays($request->to);
                $blood_pressure_data = [];
                for ($i = 1; $i <= $diff_Indays; $i++)
                {
                    $blood_pressure_data[] = Carbon::parse($request->from)->addDay($i)->toDateString();
                }
//                dd($blood_pressure_data);
                $latest_record = [];
                foreach ($blood_pressure_data as $date){
                    $latest_record[] = BloodPressure::where('user_account_id',$user_account->id)->whereDate('created_at',$date)->orderBy('created_at','DESC')->first();
                }
                foreach($latest_record as $key => $item){
                    if ($item){
                        $count += 1;
                        $low_value += $item->low_value;
                        $high_value += $item->high_value;

                        if ($item->high_value > 130 || $item->high_value < 100 || $item->low_value > 100 || $item->low_value < 60){
                            $normal_count += 1;
                        }else{
                            $high_count += 1;
                        }
                    }
                }
                if ($count!=0){
                    $low_total = round($low_value/$count);
                    $high_total = round($high_value/$count);
                }
            }
            if ($request->has('from') && !$request->has('to')){
                $records = BloodPressure::where('user_account_id',$user_account->id)->whereDate('created_at', '=', $request->from)->get();
                foreach($records as $record){
                    if ($record){
                        $count += 1;
                        $low_value += $record->low_value;
                        $high_value += $record->high_value;

                        if ($record->high_value > 130 || $record->high_value < 100 || $record->low_value > 100 || $record->low_value < 60){
                            $normal_count += 1;
                        }else{
                            $high_count += 1;
                        }
                    }
                }
                if ($count!=0){
                    $low_total = round($low_value/$count);
                    $high_total = round($high_value/$count);
                }
            }
            if (!$request->has('from') && !$request->has('to')){
                $current_date = Carbon::now();
                $record = BloodPressure::where('user_account_id',$user_account->id)->whereDate('created_at', '=', $current_date)->orderBy('created_at','DESC')->first();
                if ($record){
                    $count += 1;
                    $low_value += $record->low_value;
                    $high_value += $record->high_value;

                    if ($record->high_value > 130 || $record->high_value < 100 || $record->low_value > 100 || $record->low_value < 60){
                        $normal_count += 1;
                    }else{
                        $high_count += 1;
                    }
                }
                if ($count!=0){
                    $low_total = round($low_value/$count);
                    $high_total = round($high_value/$count);
                }
            }
            return response()->json(success_response(200,'List Of Data',
                ['low_value' => $low_total ?? 0,
                 'high_value' => $high_total ?? 0,
                 'normal_count'=>$normal_count,
                 'abnormal_count'=>$high_count
                ]));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'.$e->getMessage()));
        }
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'low_value'=>'required',
            'high_value'=>'required',
        ]);
        if($validate->fails()){
            $response = error_response(422, "Invalid Data",$validate->errors());
            return response()->json($response);
        }
        $user = UserAccount::where('email',auth()->user()->email)->firstOrFail();
        try {
            $blood_pressure = BloodPressure::create([
                'high_value'=>$request->input('high_value'),
                'low_value'=>$request->input('low_value'),
                'user_account_id'=>$user->id,
                'date_time'=>Carbon::now()->toDateTimeString(),
            ]);
            return response()->json(success_response(200,'Data Successfully inserted!',new BloodPressureResource($blood_pressure)));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'));
        }
    }
}
