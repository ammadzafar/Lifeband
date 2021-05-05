<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ExcerciseResource extends JsonResource
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
            'total_distance'=> (float)$this->distance,
            'total_time'=> Carbon::parse($this->time)->format('H:i:s'),
            'total_kcal_burned'=> (int)$this->kcal_burned,
            'total_steps'=> (int)$this->steps,
        ];
    }
}
