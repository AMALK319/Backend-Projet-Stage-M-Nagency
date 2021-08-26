<?php

namespace App\Http\Requests\CompanyRepresentative;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreCompanyRepresentativeRequest extends FormRequest
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
            'first_name' => 'string|required',
            'last_name' => 'string|required',

            'mobile_number' => 'string|required',
            'email'                 =>  'required|email|unique:users',
           /*  'password'              => ['required', 'confirmed', Password::min(8)
                                       ->mixedCase()
                                       ->letters()
                                       ->numbers()
                                       ->symbols()

            ], */
            'password'              =>  'required|confirmed',
            'password_confirmation' => 'required|same:password',
            'company_name' => 'string',
            'company_address' => 'string',
            'mission' => 'string',
        ];
    }
}
