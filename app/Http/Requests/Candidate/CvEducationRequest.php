<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CvEducationRequest extends FormRequest
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

            'degree_title' => 'required|string',
            'organism' => 'required|string',
            'organism_city' => 'string',
            'degree_start_date' => 'required|date',
            'degree_end_date' => 'required|date',
            'degree_description' => 'string',

            'project_title' => 'required|string',
            'project_description' => 'string',
            'master_project' => 'string',
            'project_start_date' => 'required|date',
            'project_end_date' => 'required|date',

        ];
    }
}
