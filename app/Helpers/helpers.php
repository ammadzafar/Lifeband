<?php


use Carbon\Carbon;

if(!function_exists('at_active')){
    function at_active($path, $active = 'active')
    {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }
}

if (!function_exists('success_response')) {

    function success_response($statusCode,$message, $data = null)
    {
        $result = [
            'statusCode' => $statusCode,
            'status' => 'success',
            'message' => $message
        ];
        if($data){
            $result['data']= $data;
        }
        return $result;
    }
}

if (!function_exists('error_response')) {

    function error_response($statusCode,$message, $errors = null)
    {
        $result = [
            'statusCode' => $statusCode,
            'status' => 'error',
            'message' => $message
        ];

        if($errors){
            $result['errors'] = $errors;
        }
        return $result;
    }
}

if (!function_exists('error_details')) {

    function error_details($e, $message)
    {
        if (env('APP_ENV') == 'production') {
            return $message . $e->getMessage();
        } else {
            return $message . 'Error on line ' . $e->getLine() . /*' in ' . $e->getFile() .*/ ' ' . $e->getMessage();
        }

    }
}

if(!function_exists('show_navbar')){
    function show_navbar($path)
    {
        return call_user_func_array('Request::is', (array)$path)  ;
    }
}
if (!function_exists('check_id')) {

    function check_id($id)
    {
        if (\App\Model\Organization::find($id))
        {
            $account_type = \App\Model\Organization::where('id',$id)->get();
            return $account_type;
        }elseif(\App\Model\FamilyAccount::find($id)){
            $account_type = \App\Model\FamilyAccount::where('id',$id)->get();
            return $account_type;
        }
    }
}
if (!function_exists('group_users')) {

    function group_users($id)
    {
        return \App\Model\UserAccount::where('account_id',$id)->where('group_id','=',null)->get();
    }
}
if (!function_exists('body_temperature')){
    function body_temperature($id){
        $avg_temp = 0;
        $count = 0;
        $multi_value = [];
        $total_temperature = [];
        $organization = \App\Model\Organization::where('id',$id)->first();
        foreach($organization->organizationUsers as $user){
            $avg_temperature = \App\Model\Api\BodyTemperature::select('value')->where('user_account_id',$user->id)
                ->whereDate('created_at', Carbon::now()->toDateString())
                ->whereTime('created_at','>=','08:00:00')
                ->whereTime('created_at','<=','09:00:00')
                ->orderBy('created_at','DESC')->first();

            array_push($multi_value,$avg_temperature);
        }
        foreach($multi_value as $temperature){
            $avg_temp += $temperature->value;
            $count += 1;
        }
        $eight_to_nine  = round($avg_temp/$count);
        array_push($total_temperature,$eight_to_nine);
//        return $eight_to_nine;

        $temp = 0;
        $item = 0;
        $new_value = [];
        foreach($organization->organizationUsers as $user){
            $avg_temperature = \App\Model\Api\BodyTemperature::select('value')->where('user_account_id',$user->id)
                ->whereDate('created_at', Carbon::now()->toDateString())
                ->whereTime('created_at','>=','09:00:00')
                ->whereTime('created_at','<=','10:00:00')
                ->orderBy('created_at','DESC')->first();

            array_push($new_value,$avg_temperature);
        }
        foreach($new_value as $temperature){
            $temp += $temperature->value;
            $item += 1;
        }
        $nine_to_ten  = round($temp/$item);
        array_push($total_temperature,$nine_to_ten);
//        dd($total_temperature);
        return $total_temperature;
    }
}





//if (!function_exists('body_temperature')) {
//
//    function body_temperature($id)
//    {
//        $organization = \App\Model\Organization::where('id',$id)->first();
//        $count = 0;
//        $multi_value = [];
//        foreach ($organization->organizationUsers as $user){
//            $avg_temperature = \App\Model\Api\BodyTemperature::select('value',DB::raw('HOUR(created_at) as hour'))->where('user_account_id',$user->id)
//                ->whereDate('created_at', Carbon::now()->toDateString())
//                ->orderBy('created_at','DESC')
//                ->distinct('user_account_id')
//                ->get()
//
//                ->groupBy('hour');
//
//            array_push($multi_value,$avg_temperature);
//        }
//        dd($multi_value);
////        dd($avg_temperature);
//        $avg_value = 0;
//        foreach ($avg_temperature as $data){
////            dd($data[0]);
//            foreach ($data as $item){
////                dd($item);
//                $count += 1;
//                $avg_value += $item->value;
//                $hour = $item->hour;
//            }
//        }
//        dd($avg_value);
//    }
//}

if (!function_exists('family_account')) {

    function family_account($id)
    {
        return \App\Model\UserAccount::where('account_id',$id)->where('group_id','=',null)->get();
    }
}
if (!function_exists('alphabet_increment')) {

    function alphabet_increment($key)
    {
        if ($key == 0) {
            return 'A';
        }elseif ($key == 1){
            return 'B';
        }elseif ($key == 2){
            return 'C';
        }elseif ($key == 3){
            return 'D';
        }elseif ($key == 4){
            return 'F';
        }elseif ($key == 5){
            return 'G';
        }elseif ($key == 6){
            return 'H';
        }elseif ($key == 7) {
            return 'I';
        }else{
            return $key;
        }
    }
}
