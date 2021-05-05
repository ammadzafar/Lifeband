<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PedometerResource extends JsonResource
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
            'distance_covered'=>(int)$this->distance_covered,
            'steps'=>(int)$this->steps,
            'calories_burnt'=>(int)$this->calories_burnt,
        ];
    }
}
