<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class StoreCandidateRequest extends FormRequest
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
            'last_name'              =>  'required|string',
            'first_name'             =>  'required|string',
            'email'                 =>  'required|email|unique:users',
            'password'              => ['required', 'confirmed', Password::min(8)
                                       ->mixedCase()
                                       ->letters()
                                       ->numbers()
                                       ->symbols()

            ],
            'password_confirmation' => 'required|same:password',
           /*  'gender'                =>  'required|in:Mr,Mme', */
            'mobile_number'          =>  'required|string',
            /* 'birth_place'            =>  'string',
            'date_of_birth'           =>  'date', */
            'nationality'           =>  'required|string',
           /*  'speciality'            =>  'required|in:Développment full-stack , Réseaux et Télecommunications , Cloud ' */

        ];
    }
}
