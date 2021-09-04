<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

/* use CloudCreativity\LaravelJsonApi\Rules\HasMany; */

class StoreCvRequest extends FormRequest
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
          
            'degrees.degree_title' => 'required|string',
            'degrees.organism' => 'required|string',
            'degrees.organism_city' => 'string',
            'degrees.degree_start_date' => 'required|date|before:degrees.*.degree_end_date',
            'degrees.degree_end_date' => 'required|date|after:degrees.*.degree_start_date' ,

  


        ];
    }

}