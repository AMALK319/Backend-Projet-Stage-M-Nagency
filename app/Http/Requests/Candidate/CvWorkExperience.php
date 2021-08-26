<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CvWorkExperienceRequest extends FormRequest
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
            'experience_title' => 'required|string',
            'enterprise_name' => 'required|string',
            'enterprise_city' => 'string',
            'enterprise_address' => 'string',
            'experience_start_date' => 'required|date',
            'experience_end_date' => 'required|date',
            'experience_description' => 'string',

            'certification_name' => 'required|string',
            'issuing_agency' => 'required|string',
            'issue_date' => 'required|date',
            'expiration_date' => 'date',
            'degree_id' => 'required|string',
            'degree_url' => 'required|string',
        ];
    }
}
