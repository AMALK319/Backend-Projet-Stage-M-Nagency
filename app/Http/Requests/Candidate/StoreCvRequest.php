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
            /*   Degree */
            'degrees' => 'array|min:1',
            'degrees.*.degree_title' => 'required|string',
            'degrees.*.organism' => 'required|string',
            'degrees.*.organism_city' => 'string',
            'degrees.*.degree_start_date' => 'required|date|before:degrees.*.degree_end_date',
            'degrees.*.degree_end_date' => 'required|date|after:degrees.*.degree_start_date' ,
            
    /* Academic Projects */
            'projects' => 'array|min:1',
            'projects.*.project_title' => 'required|string',
            'projects.*.project_description' => 'string',
           
            'projects.*.project_start_date' => 'required|date',
            'projects.*.project_end_date' => 'required|date',
   /*   Professional Experience */
         /*    'experiences' => 'required|array|min:1',
            'experiences.*.experience_title' => 'required|string',
            'experiences.*.enterprise_name' => 'required|string',
            'experiences.*.enterprise_city' => 'string',
            'experiences.*.enterprise_address' => 'string',
            'experiences.*.experience_start_date' => 'required|date',
            'experiences.*.experience_end_date' => 'required|date',
            'experiences.*.experience_description' => 'string', */
 /*   Certifications */
           /*  'certifications' => 'required|array|min:1',
            'certifications.*.certification_name' => 'required|string',
            'certifications.*.issuing_agency' => 'required|string',
            'certifications.*.issue_date' => 'required|date',
            'certifications.*.expiration_date' => 'date',
            'certifications.*.degree_id' => 'required|string',
            'certifications.*.degree_url' => 'required|string', */
     /* Competences */
            'competences' => 'array|min:1',
            'competences.*.competence' => 'required|string',
            'competences.*.competence_description' => 'string',
     /* Languages */
            'languages' => 'array|min:1',
            'languages.*.language' => 'required|string',
     /* Motivation */

            'motivation' => 'required|string',
   /*   Qualities */
            'qualities' => 'array|min:1',
            'qualities.*.quality' => 'required|string',
   /*Coordonnées*/
            'last_name'              =>  'required|string',
            'first_name'             =>  'required|string',
            'email'                 =>  'required|email',
            'gender'                =>  'required|in:Mr,Mme',
            'mobile_number'          =>  'required|string',
            'address'            =>  'string',
            'date_of_birth'           =>  'date',
            'nationality'           =>  'required|string',
            'speciality'            =>  'required',
            'speciality'            =>  'string',
            
        ];
    }

}
