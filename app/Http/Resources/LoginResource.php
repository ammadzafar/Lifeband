<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            'user'=>[
                "id" => $this[0]->id,
                'name' => $this[0]->name,
                "email" => $this[0]->email,
                "image" => $this[0]->image,
            ],
            'access_token' =>$this[1],
        ];
    }
}
