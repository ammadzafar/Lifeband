<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAccountResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name ?? null,
            'email'=>$this->email ?? null,
            'image'=>$this->image ?? null,
            'gender'=>$this->gender ?? null,
            'age'=>(int)$this->age ?? 0,
            'height'=>(int)$this->height ?? 0,
            'height_unit'=>$this->height_unit ?? null,
            'weight'=>(int)$this->weight ?? 0,
            'weight_unit'=>$this->weight_unit ?? null,
            'step_length'=> (int)$this->step_length ?? 0,
            'step_length_unit'=>$this->step_length_unit ?? null,
            'wear_side'=>$this->wear_side ?? null,
            'personal_goal'=>(int)$this->personal_goal ?? 0,
            'temperature_unit'=>$this->temperature_unit ?? null,
        ];
    }
}
