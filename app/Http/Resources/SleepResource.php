<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SleepResource extends JsonResource
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
            'shallow_sleep'=>$this->shallow_sleep,
            'deep_sleep'=>$this->deep_sleep,
            'wakeup_times'=>(int)$this->wake_up_times,
        ];
    }
}
