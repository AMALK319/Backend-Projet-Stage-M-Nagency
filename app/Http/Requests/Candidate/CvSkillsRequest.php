<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CvSkillsRequest extends FormRequest
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
            'competence' => 'required|string',
            'competence_description' => 'string',

            'language' => 'required|string',

            'motivation' => 'required|string',

            'quality' => 'required|string',




        ];
    }
}
