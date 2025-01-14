<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class submitDefineAccessRequest extends FormRequest
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
            'password'=>'required|same:confirm_password',
            'confirm_password'=>'required|same:password'
        ];
    }

    public function messages(){
        return[
            'password.same'=>'Les mots de passe ne correspondent pas',
            'confirm_password.same'=>'Les mots de passe ne correspondent pas'

        ];
    }
}
