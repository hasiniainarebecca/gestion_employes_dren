<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class saveServiceRequest extends FormRequest
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
            'nom'=>'required|unique:services,nom'
        ];
    }
    public function message(){
        return [
            'nom.required'=>'Le nom du service est requis',
            'nom.unique'=>'Le nom du service existe déjà'
        ];
    }
}
