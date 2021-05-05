<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'minutes_per_km' => Carbon::parse($this->minutes_per_km)->format('i:s'),
            'distance'=>$this->distance,
            'kcal_burned' => $this->kcal_burned,
            'steps' => $this->steps,
            'date_time' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
