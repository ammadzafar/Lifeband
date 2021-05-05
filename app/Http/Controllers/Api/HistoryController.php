<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\HistoryResource;
use App\Model\Api\Running;
use App\Model\UserAccount;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class HistoryController extends Controller
{
    public function show(){

        try {
            $user = UserAccount::where('email',auth()->user()->email)->firstorfail();
            $history = Running::where('user_account_id',$user->id)->paginate(20);

            if ($history->items()){
                $historyResource = HistoryResource::collection(new Collection($history->items()));
                $count = 0;
                $average_distance = 0;
                foreach($historyResource as $item){
                    $average_distance += $item->distance;
                    $count += 1;
                }
                $response = [
                    'average_distance' => round($average_distance/$count),
                    'total_runs' => $count,
                    'data' => $historyResource,
                    'data' => $historyResource,
                    'total' => $history->total(),
                    'perPage' => $history->perPage(),
                    'lastPage' => $history->lastPage(),
                    'next_page_url' => $history->nextPageUrl(),
                    'previous_page_url' => $history->previousPageUrl(),
                    'last_page_url' => $history->url($history->lastPage()),
                ];
                return response()->json(success_response(200,'List of Data', $response));
            }
            return response()->json(success_response(200,'Particular user has no history to show!',['running_history'=>[]]));

        }catch(\Exception $e){
            return response()->json(error_response(500,'Something Went Wrong! '.$e->getMessage()));
        }
    }
}
