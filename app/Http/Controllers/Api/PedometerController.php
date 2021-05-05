<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PedometerResource;
use App\Model\Api\Pedometer;
use App\Model\UserAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PedometerController extends Controller
{
    public function show(Request $request){

        try {
            $user_account = UserAccount::where('email',$request->user()->email)->first();
            $pedometerQuery = Pedometer::query();
            $pedometerQuery->where('user_account_id',$user_account->id);
            $count = 0;
            $distance_covered = 0;
            $steps = 0;
            $calories_burnt = 0;

            if($request->has('from') && $request->has('to')){
                $diff_Indays = Carbon::parse($request->from)->diffInDays($request->to);
                $pedometer_data = [];
                for ($i = 1; $i <= $diff_Indays; $i++)
                {
                    $pedometer_data[] = Carbon::parse($request->from)->addDay($i)->toDateString();
                }
                $latest_record = [];
                foreach ($pedometer_data as $date){
                    $latest_record[] = Pedometer::where('user_account_id',$user_account->id)->whereDate('created_at',$date)->orderBy('created_at','DESC')->first();
                }
                foreach($latest_record as $key => $item){
                    if ($item){
                        $count += 1;
                        $distance_covered += $item->distance_covered;
                        $steps += $item->steps;
                        $calories_burnt += $item->calories_burnt;
                    }
                }
                if ($count!=0){
                    $total_distance = round($distance_covered);
                    $total_steps = round($steps);
                    $total_calories_burnt = round($calories_burnt);
                }
            }
            if ($request->has('from') && !$request->has('to')){
                $records = Pedometer::where('user_account_id',$user_account->id)->whereDate('created_at', '=', $request->from)->get();
                foreach ($records as $item){
                    $count += 1;
                    $distance_covered += $item->distance_covered;
                    $steps += $item->steps;
                    $calories_burnt += $item->calories_burnt;
                }
                if ($count!=0){
                    $total_distance = round($distance_covered);
                    $total_steps = round($steps);
                    $total_calories_burnt = round($calories_burnt);
                }
            }
            if (!$request->has('from') && !$request->has('to')){
                $current_date = Carbon::now();
                $record = Pedometer::where('user_account_id',$user_account->id)->whereDate('created_at', '=', $current_date)->orderBy('created_at','DESC')->first();
                if ($record){
                    $count += 1;
                    $distance_covered += $record->distance_covered;
                    $steps += $record->steps;
                    $calories_burnt += $record->calories_burnt;
                }
                if ($count!=0){
                    $total_distance = round($distance_covered);
                    $total_steps = round($steps);
                    $total_calories_burnt = round($calories_burnt);
                }

            }
            return response()->json(success_response(200,'List Of Data',
                ['distance_covered' => $total_distance ?? 0,
                 'steps' => $total_steps ?? 0,
                 'calories_burnt' => $total_calories_burnt ?? 0,
                ]));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong '.$e->getMessage()));
        }
    }
    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'distance_covered'=>'required',
            'steps'=>'required',
            'calories_burnt'=>'required',
        ]);
        if($validate->fails()){
            $response = error_response(422,"Invalid Data", $validate->errors());
            return response()->json($response);
        }
        $user = UserAccount::where('email',auth()->user()->email)->firstOrFail();
        try {
            $pedometer = Pedometer::create([
                'distance_covered'=>$request->input('distance_covered'),
                'steps'=>$request->input('steps'),
                'calories_burnt'=>$request->input('calories_burnt'),
                'user_account_id'=>$user->id,
                'date_time'=>Carbon::now()->toDateTimeString(),
            ]);
            return response()->json(success_response(200,'Data Successfully inserted!',new PedometerResource($pedometer)));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong!'));
        }
    }
}
