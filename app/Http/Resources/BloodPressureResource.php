<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BloodPressureResource extends JsonResource
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
            'low_value'=>(int)$this->low_value,
            'high_value'=>(int)$this->high_value,
        ];
    }
}
