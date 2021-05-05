<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class RunningResource extends JsonResource
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
            'distance'=>(int)$this->distance,
            'steps'=> (int)$this->steps,
            'kcal_burned'=> (int)$this->kcal_burned,
            'minutes_per_km'=> Carbon::parse($this->minutes_per_km)->format('H:i:s'),
            'total_time'=> Carbon::parse($this->time)->format('H:i:s'),
        ];
    }
}
