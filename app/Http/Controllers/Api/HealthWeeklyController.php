<?php

namespace App\Http\Controllers\Api;

use App\Model\Api\BloodOxygen;
use App\Model\Api\BloodPressure;
use App\Model\Api\BodyTemperature;
use App\Model\Api\Fatigue;
use App\Model\Api\HeartRate;
use App\Model\Api\Pedometer;
use App\Model\Api\Sleep;
use App\Model\UserAccount;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HealthWeeklyController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Carbon\Exceptions\InvalidFormatException
     */
    public function show(Request $request){

        try {
            $user_account = UserAccount::where('email',$request->user()->email)->first();
            $heart_rate_data = null;
            $heart_rate = HeartRate::select('value')->where('user_account_id',$user_account->id)
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY),
                  Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get();
            foreach($heart_rate as $item){
               $heart_rate_data += $item->value;
            }
            if (count($heart_rate) > 0){
                    $total_heart_rate = round($heart_rate_data/count($heart_rate));
            }else{
                $total_heart_rate = 0;
            }

            $blood_oxygen_data = null;
            $blood_oxygen = BloodOxygen::select('value')->where('user_account_id',$user_account->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get();
            foreach($blood_oxygen as $item){
                $blood_oxygen_data += $item->value;
            }
            if (count($blood_oxygen) > 0){
                $total_blood_oxygen = round($blood_oxygen_data/count($blood_oxygen));
            }else{
                $total_blood_oxygen = 0;
            }

            $blood_pressure_low = null;
            $blood_pressure_low_value = BloodPressure::select('low_value')->where('user_account_id',$user_account->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get();
            foreach($blood_pressure_low_value as $item){
                $blood_pressure_low += $item->low_value;
            }
            if (count($blood_pressure_low_value) > 0){
                $total_low_blood_pressure = round($blood_pressure_low/count($blood_pressure_low_value));
            }else{
                $total_low_blood_pressure = 0;
            }

            $blood_pressure_high = null;
            $blood_pressure_high_value = BloodPressure::select('high_value')->where('user_account_id',$user_account->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get();
            foreach($blood_pressure_high_value as $item){
                $blood_pressure_high += $item->high_value;
            }
            if (count($blood_pressure_high_value) > 0){
                $total_high_blood_pressure = round($blood_pressure_high/count($blood_pressure_high_value));
            }else{
                $total_high_blood_pressure = 0;
            }

            $body_temperature_data = null;
            $body_temperature = BodyTemperature::select('value')->where('user_account_id',$user_account->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get();
            foreach($body_temperature as $item){
                $body_temperature_data += $item->value;
            }
            if (count($body_temperature) > 0){
                $total_body_temperature = round($body_temperature_data/count($body_temperature));
            }else{
                $total_body_temperature = 0;
            }

            $light_sleep_hours = 0;
            $light_sleep_minutes = 0;
            $deep_sleep_hours = 0;
            $deep_sleep_minutes = 0;
            $sleep_count = 0;
            $sleep_record = Sleep::where('user_account_id',$user_account->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get();

            foreach($sleep_record as $key => $item){
                $sleep_count += 1;
                $light_sleep_hours += Carbon::parse($item->shallow_sleep)->format('H');
                $light_sleep_minutes += Carbon::parse($item->shallow_sleep)->format('i');
                $deep_sleep_hours += Carbon::parse($item->deep_sleep)->format('H');
                $deep_sleep_minutes += Carbon::parse($item->deep_sleep)->format('i');
            }
            if (count($sleep_record) > 0){
                $total_shallow_sleep = round($light_sleep_hours/count($sleep_record)).':'.round($light_sleep_minutes/count($sleep_record));
                $total_deep_sleep = round($deep_sleep_hours/count($sleep_record)).':'.round($deep_sleep_minutes/count($sleep_record));
            }else{
                $total_shallow_sleep = 0;
                $total_deep_sleep = 0;
            }

            $distance_covered = 0;
            $pedometer_count = 0;
            $calories_burn = 0;
            $steps = 0;
            $pedometer_latest_record = Pedometer::where('user_account_id',$user_account->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get();
            foreach($pedometer_latest_record as $key => $item){
                    $pedometer_count += 1;
                    $distance_covered += $item->distance_covered;
                    $steps += $item->steps;
                    $calories_burn += $item->calories_burnt;
            }
            if ($pedometer_count > 0){
                $total_distance_covered = round($distance_covered);
                $total_steps = round($steps);
                $total_calories_burnt = round($calories_burn);
            }else{
                $total_distance_covered = 0;
                $total_steps = 0;
                $total_calories_burnt = 0;
            }

            $fatigue_data = null;
            $fatigue = Fatigue::where('user_account_id',$user_account->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get();
            foreach($fatigue as $item){
                $fatigue_data += $item->value;
            }
            if (count($fatigue) > 0){
                $total_fatigue = round($fatigue_data/count($fatigue));
            }else{
                $total_fatigue = 0;
            }

            return response()->json(success_response(200,'Weekly Report',[
                'heart_rate' => $total_heart_rate ,
                'fatigue' => $total_fatigue,
                'blood_pressure'=>[ 'low_value' => $total_low_blood_pressure ,'high_value' => $total_high_blood_pressure ,],
                'sleep_record'=>[ 'shallow_sleep' => $total_shallow_sleep,'deep_sleep' => $total_deep_sleep],
                'blood_oxygen' => $total_blood_oxygen ,

                'body_temperature' => $total_body_temperature,
                'pedometer' => ['distance_covered'=>$total_distance_covered ,'steps'=>$total_steps ,'calories_burnt'=>$total_calories_burnt ,]
            ]));
        }catch (\Exception $e){
            return response()->json(error_response(500,'Something went wrong! '.$e->getMessage()));
        }
    }
}
