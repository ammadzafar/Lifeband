<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InviteUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'image'=>'required',
            'gender'=>'required',
            'age'=>'required',
            'email'=>'required',
            'password'=>'required',
            'weight'=>'required',
            'height'=>'required',
            'wear_side'=>'required',
            'personal_goal'=>'required',
        ];
    }
}
