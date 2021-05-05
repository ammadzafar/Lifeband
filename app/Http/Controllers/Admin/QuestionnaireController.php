<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\QuestionnaireAnswerResource;
use App\Http\Resources\QuestionnaireResource;
use App\Model\Api\QuestionnaireAnswer;
use App\Model\FamilyAccount;
use App\Model\Option;
use App\Model\Organization;
use App\Model\Questionnaire;
use App\Model\User;
use App\Model\UserAccount;
use App\Services\Admin\QuestionnaireServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class QuestionnaireController extends Controller
{
    public $questionnaire;
    public function __construct(QuestionnaireServices $questionnaire)
    {
        return $this->questionnaire = $questionnaire;
    }

    public function create($id)
    {
//        dd($id);
        $organization = Organization::find($id);
        $family_account = FamilyAccount::find($id);
        if ($organization != null){
            return view('admin.questionnaire.add-questionnaire',compact('organization'));
        }
            return view('admin.questionnaire.add-questionnaire',compact('family_account'));

    }
    public function userQuestionnaire($id)
    {
        $user = User::find($id);
        return view('admin.questionnaire.add-questionnaire',compact('user'));
    }
    public function store(Request $request)
    {
        $question = new Questionnaire();
        $question->questionnaire = $request->question;

        $organization = Organization::find($request->id);
        $family_account = FamilyAccount::find($request->id);

        if($organization != null){
            $question->admin_id = $organization->id;
            $question->creator_type = 'organization admin';
        }elseif ($family_account != null){
            $question->admin_id = $family_account->id;
            $question->creator_type = 'family admin';
        }else{
            $question->admin_id = $request->id;
            $question->creator_type = 'super admin';
        }
        $question->save();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Question successfully created',
                'question_id'   =>  $question->id
            ]);
    }
    public function delete(Request $request){
        $question = Questionnaire::find($request->question_id);
        $question->delete();
        $options = Option::where('question_id',$request->question_id)->get();
        foreach($options as $option){
            $option->delete();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Questionnaire Successfully Deleted'
        ]);
    }
    public function history($id)
    {
        $organization = Organization::find($id);
        $family_account = FamilyAccount::find($id);
        if ($organization != null) {
            $questionnaire = Questionnaire::where('admin_id',$organization->id)->get();
            return view('admin.questionnaire.history',compact('questionnaire','organization'));
        }else{
            $questionnaire = Questionnaire::where('admin_id',$family_account->id)->get();
            return view('admin.questionnaire.history',compact('questionnaire','family_account'));
        }

    }
    public function adminHistory($id){
        $questionnaire = Questionnaire::where('admin_id',$id)->get();
        return view('admin.questionnaire.history',compact('questionnaire'));
    }
    public function show(){

        try {
            $questionnaire = QuestionnaireResource::collection(Questionnaire::where('creator_type','super admin')->get());
            if ($questionnaire){
                return response()->json(success_response('200','List of Questions',$questionnaire));
            }
        }catch (\Exception $e){
            return response()->json(error_response('500','Something went wrong!'));
        }
    }
    public function storeUserAnswers(Request $request){
        $validate = Validator::make($request->all(),[
            'answer' => 'required',
            'questionnaire_id' => 'required',
        ]);
        if($validate->fails()){
            $response = error_response('Invalid Data', $validate->errors());
            return response()->json($response);
        }
        try {
            $user = UserAccount::where('email',auth()->user()->email)->firstOrFail();
            $answer = QuestionnaireAnswer::create([
                'user_account_id' => $user->id,
                'questionnaire_id' => $request->input('questionnaire_id'),
                'answer' => $request->input('answer'),
            ]);
            return response()->json(success_response(200,'Your Have Successfully Answered The Question! ',new QuestionnaireAnswerResource($answer)));
        }catch (\Exception $e){
            return response()->json(error_response(500,'something went wrong!'));
        }
    }
}
