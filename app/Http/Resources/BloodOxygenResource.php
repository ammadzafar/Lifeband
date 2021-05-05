<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BloodOxygenResource extends JsonResource
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
            'value'=>(int)$this->value,
        ];
    }
}
