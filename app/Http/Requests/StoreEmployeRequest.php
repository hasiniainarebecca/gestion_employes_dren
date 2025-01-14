<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeRequest extends FormRequest
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
            'nom'=>'required|string',
            'prenom'=>'required|string',
            'date_naissance'=>'nullable',
            'sexe'=>'required|string',
            'email'=>'required|unique:employes,email',
            'contact'=>'required|unique:employes,contact',
            'montant_journalier'=>'',
            'service_id'=>'required|integer',
            'photo'=>'required|string'
        ];
    }

    public function message(){
        return [
            'email.required'=>'Le mail est requis',
            'email.unique'=>'Le mail saisie est déjà utilisé par un autre employé',
            'contact.required'=>'Le numéro de téléphpne est requis',
            'contact.unique'=>'Le numéro de téléphone saisie est déjà utilisé par un autre employé'
        ];
    }
}
