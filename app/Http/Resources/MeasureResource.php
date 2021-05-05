<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MeasureResource extends JsonResource
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
            'heart_rate'=>(int)$this->heart_rate ?? 0,
            'blood_oxygen' => (int)$this->blood_oxygen ?? 0,
            'blood_pressure_high' => (int)$this->blood_pressure_high ?? 0,
            'blood_pressure_low' => (int)$this->blood_pressure_low ?? 0,
        ];
    }
}
