<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FamilyAccountRequest extends FormRequest
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
            'admin_name'=>'required',
            'contact_no'=>'required',
            'image' => 'required|mimes:jpeg,png,jpg,svg',
            'email' => 'required|unique:organizations',
            'bands' => 'required',
            'emergency_contact'=>'required',
        ];
    }
}
