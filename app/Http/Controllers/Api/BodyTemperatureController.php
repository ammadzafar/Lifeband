<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BodyTemperatureResource;
use App\Model\Api\BodyTemperature;
use App\Model\UserAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BodyTemperatureController extends Controller
{
    public function show(Request $request){

        try {
            $user_account = UserAccount::where('email',$request->user()->email)->first();
            $body_temperatureQuery = BodyTemperature::query();
            $body_temperatureQuery->where('user_account_id',$user_account->id);
            $count = 0;
            $value = 0;
            if($request->has('from') && $request->has('to')){
                $diff_Indays = Carbon::parse($request->from)->diffInDays($request->to);
                $body_temperature_data = [];
                for ($i = 1; $i <= $diff_Indays; $i++)
                {
                    $body_temperature_data[] = Carbon::parse($request->from)->addDay($i)->toDateString();
                }
                $latest_record = [];
                foreach ($body_temperature_data as $date){
                    $latest_record[] = BodyTemperature::where('user_account_id',$user_account->id)->whereDate('created_at',$date)->orderBy('created_at','DESC')->first();
                }
                foreach($latest_record as $key => $item){
                    if ($item){
                        $count += 1;
                        $value += $item->value;
                    }
                }
                if ($count!=0){
                    $total = round($value/$count);
                }
            }
            if ($request->has('from') && !$request->has('to')){
                $records = BodyTemperature::where('user_account_id',$user_account->id)->whereDate('created_at', '=', $request->from)->get();
                foreach ($records as $record){
                    if ($record){
                        $count += 1;
                        $value += $record->value;
                    }
                }
                if ($count!=0){
                    $total = round($value/$count);
                }
            }
            if (!$request->has('from') && !$request->has('to')){
                $current_date = Carbon::now();
                $record = BodyTemperature::where('user_account_id',$user_account->id)->whereDate('created_at', '=', $current_date)->orderBy('created_at','DESC')->first();
                if ($record){
                    $count += 1;
                    $value += $record->value;
                }
                if ($count!=0){
                    $total = round($value/$count);
                }
            }
            return response()->json(success_response(200,'List Of Data',['value' => $total ?? 0]));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'/*.$e->getMessage()*/));
        }
    }
    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'value'=>'required',
        ]);
        if($validate->fails()){
            $response = error_response(422,"Invalid Data" ,$validate->errors());
            return response()->json($response);
        }
        $user = UserAccount::where('email',auth()->user()->email)->firstOrFail();
        $user->temperature = $request->value;
        $user->save();
        try {
            $body_temperature = BodyTemperature::create([
                'value'=>$request->input('value'),
                'user_account_id'=>$user->id,
                'date_time'=>Carbon::now()->toDateTimeString(),
            ]);
            return response()->json(success_response(200,'Data Successfully inserted!',new BodyTemperatureResource($body_temperature)));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'/*.$e->getMessage()*/));
        }
    }
}
