<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Collection;

class PaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        dd($this->items->toArray());
     return [
//        'data' => HistoryResource::collection(new Collection($this->items())),
//         'first_page_url' => $this->first_page_url(),
//         'current_page' => $this->current_page(),
//         'from' => $this->from(),
//         'last_page' => $this->last_page(),
//         'last_page_url' => $this->last_page_url(),
//         'next_page_url' => $this->next_page_url(),
//         'per_page' => $this->per_page(),
         'total' => $this->perPage(),
//         'prev_page_url' => $this->prev_page_url(),
     ];
    }
}
