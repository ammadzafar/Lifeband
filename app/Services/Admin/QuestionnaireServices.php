<?php


namespace App\Services\Admin;


use App\Model\Questionnaire;

class QuestionnaireServices
{
    public function store($request,$data)
    {
        $question = new Questionnaire();
        $question->questionnaire = $data;
        $question->admin_id = $request->admin_id;
        $question->creator_type = $request->creator_type;
        $question->save();
    }
}
