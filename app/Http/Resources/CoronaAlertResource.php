<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoronaAlertResource extends JsonResource
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
            'contact_person_bluetooth_address'=>$this->contact_person_bluetooth_address,
            'contact_type'=>$this->contact_type,
        ];
    }
}
