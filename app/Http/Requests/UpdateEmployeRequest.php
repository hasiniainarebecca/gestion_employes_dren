<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeRequest extends FormRequest
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
        return[
            'nom'=>'required|string',
            'prenom'=>'required|string',
            'date_naissance'=>'nullable|date',
            'sexe'=>'required|string',
            'email'=>'required',
            'contact'=>'required',
            'montant_journalier'=>'',
            'service_id'=>'required|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function message(){
        return [
            'email.required'=>'Le mail est requis',
            'contact.required'=>'Le numéro de téléphpne est requis',
            'nom.required'=>'Le nom est requis',
            'prenom.required'=>'Le prénom est requis',
            'sexe.required'=>'Le genre est requis',
        ];
    }
}
