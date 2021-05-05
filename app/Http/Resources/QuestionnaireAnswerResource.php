<?php

namespace App\Http\Resources;

use App\Model\Questionnaire;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionnaireAnswerResource extends JsonResource
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
            'question'=>Questionnaire::where('id',$this->questionnaire_id)->pluck('questionnaire')->first(),
            'answer'=>$this->answer,
        ];
    }
}
