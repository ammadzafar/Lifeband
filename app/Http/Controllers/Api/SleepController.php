<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SleepResource;
use App\Model\Api\Sleep;
use App\Model\UserAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SleepController extends Controller
{
    public function show(Request $request){

        try {
            $user_account = UserAccount::where('email',$request->user()->email)->first();
            $sleepQuery = Sleep::query();
            $sleepQuery->where('user_account_id',$user_account->id);
            $count = 0;
            $light_sleep_hours = 0;
            $light_sleep_minutes = 0;
            $deep_sleep_hours = 0;
            $deep_sleep_minutes = 0;

            if($request->has('from') && $request->has('to')){
                $diff_Indays = Carbon::parse($request->from)->diffInDays($request->to);
                $sleep_data = [];
                for ($i = 1; $i < $diff_Indays; $i++)
                {
                    $sleep_data[] = Carbon::parse($request->from)->addDay($i)->toDateString();
                }
                $latest_record = [];
                foreach ($sleep_data as $date){
                    $latest_record[] = Sleep::where('user_account_id',$user_account->id)->whereDate('created_at',$date)->orderBy('created_at','DESC')->first();
                }
                foreach($latest_record as $key => $item){
                    if ($item){
                        $count += 1;
                        $light_sleep_hours += Carbon::parse($item->shallow_sleep)->format('H');
                        $light_sleep_minutes += Carbon::parse($item->shallow_sleep)->format('i');
                        $deep_sleep_hours += Carbon::parse($item->deep_sleep)->format('H');
                        $deep_sleep_minutes += Carbon::parse($item->deep_sleep)->format('i');
                    }
                }
                if ($count!=0){
                    $total_light_sleep = round($light_sleep_hours/$count).':'.round($light_sleep_minutes/$count);
                    $total_deep_sleep = round($deep_sleep_hours/$count).':'.round($deep_sleep_minutes/$count);
                }
            }

            if ($request->has('from') && !$request->has('to')){
                $record = Sleep::where('user_account_id',$user_account->id)->whereDate('created_at', '=', $request->from)->orderBy('created_at','DESC')->first();
                if ($record){
                    $count += 1;
                    $light_sleep_hours += Carbon::parse($record->shallow_sleep)->format('H');
                    $light_sleep_minutes += Carbon::parse($record->shallow_sleep)->format('i');
                    $deep_sleep_hours += Carbon::parse($record->deep_sleep)->format('H');
                    $deep_sleep_minutes += Carbon::parse($record->deep_sleep)->format('i');
                }
                if ($count!=0){
                    $total_light_sleep = round($light_sleep_hours/$count).':'.round($light_sleep_minutes/$count);
                    $total_deep_sleep = round($deep_sleep_hours/$count).':'.round($deep_sleep_minutes/$count);
                }
            }
            if (!$request->has('from') && !$request->has('to')){
                $current_date = Carbon::now();
                $records = Sleep::where('user_account_id',$user_account->id)->whereDate('created_at', '=', $current_date)->get();
                foreach ($records as $record){
                    if ($record){
                        $count += 1;
                        $light_sleep_hours += Carbon::parse($record->shallow_sleep)->format('H');
                        $light_sleep_minutes += Carbon::parse($record->shallow_sleep)->format('i');
                        $deep_sleep_hours += Carbon::parse($record->deep_sleep)->format('H');
                        $deep_sleep_minutes += Carbon::parse($record->deep_sleep)->format('i');
                    }
                }
                if ($count!=0){
                    $total_light_sleep = round($light_sleep_hours/$count).':'.round($light_sleep_minutes/$count);
                    $total_deep_sleep = round($deep_sleep_hours/$count).':'.round($deep_sleep_minutes/$count);
                }
            }
            return response()->json(success_response(200,'List Of Data',
                ['shallow_sleep' => $total_light_sleep  ?? 0,
                    'deep_sleep' => $total_deep_sleep ?? 0,
                ]));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'/*.$e->getMessage()*/));
        }
    }
    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'shallow_sleep'=>'required',
            'deep_sleep'=>'required',
            'wake_up_times'=>'required',
        ]);
        if($validate->fails()){
            $response = error_response(422,"Invalid Data", $validate->errors());
            return response()->json($response);
        }
        $user = UserAccount::where('email',auth()->user()->email)->firstOrFail();

        try {
            $sleep_data = Sleep::create([
                'shallow_sleep'=>$request->input('shallow_sleep'),
                'deep_sleep'=>$request->input('deep_sleep'),
                'wake_up_times'=>$request->input('wake_up_times'),
                'user_account_id'=>$user->id,
                'date_time'=>Carbon::now()->toDateTimeString(),
            ]);
            return response()->json(success_response(200,'Data Successfully inserted!',new SleepResource($sleep_data)));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'));
        }
    }
}

