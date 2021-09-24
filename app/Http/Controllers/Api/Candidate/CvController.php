<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Models\Degree;
use App\Models\Quality;
use App\Models\Language;
use App\Models\Candidate;
use App\Models\Competence;
use App\Models\Motivation;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Models\AcademicProject;
use App\Models\CategoryCandidate;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfessionalExperience;
use App\Http\Requests\Candidate\StoreCvRequest;

class CvController extends Controller
{
   

    /**
     * Store a newly cv of the connected candidate.
    
     */
    public function store(StoreCvRequest $request)
    {
        try {

            DB::beginTransaction();


            $candidate = Candidate::where('id' , Auth::user()->userable_id)->first();
            $degrees = collect($request->degrees);
            foreach ($degrees as $item) {
                $newDegree = Degree::create([
                    'degree_title' => $item['degree_title'],
                    'organism' => $item['organism'],
                    'organism_city' => $item['organism_city'],
                    'degree_start_date' => $item['degree_start_date'],
                    'degree_end_date' => $item['degree_end_date'],
                    'degree_description' => $item['degree_description'],
                    'candidate_id' => $candidate->id,
                ]);
            }

            $projects = collect($request->projects);
            foreach ( $projects as $item){
                $newAcademicProject = AcademicProject::create([
                    'project_title' => $item['project_title'],
                    'project_description' => $item['project_description'],
                    'master_project' => $item['master_project'],
                    'project_start_date' => $item['project_start_date'],
                    'project_end_date' => $item['project_end_date'],
                    'candidate_id' => $candidate->id,
                ]);
            }

            $experiences = collect($request->experiences);
            foreach($experiences as $item){
                $newProfessionalExperience = ProfessionalExperience::create([
                    'experience_title' => $item['experience_title'],
                    'enterprise_name' => $item['enterprise_name'],
                    'enterprise_city' => $item['enterprise_city'],
                    'enterprise_address' => $item['enterprise_address'],
                    'experience_start_date' => $item['experience_start_date'],
                    'experience_end_date' => $item['experience_end_date'],
                    'experience_description' => $item['experience_description'],

            ]);
            }

            $certifications = collect($request->certifications);
            foreach($certifications as $item){
                $newCertification = Certification::create([
                    'certification_name' => $item['certification_name'],
                    'issuing_agency' => $item['issuing_agency'],
                    'issue_date' => $item['issue_date'],
                    'expiration_date' => $item['expiration_date'],
                    'degree_id' => $item['degree_id'],
                    'degree_url' => $item['degree_url'],

            ]);
           } 
           $competences = collect($request->competences);
           foreach ( $competences as $item){
                $newCompetence = Competence::create([
                    'competence' => $item['competence'],
                    'competence_description' => $item['competence_description'],
                    'candidate_id' => $candidate->id,
            ]);
           }



            $languages = collect($request->languages);
            foreach($languages as $item){
                $newLanguage = Language::create([
                    'language' => $item['language'],
                    'candidate_id' => $candidate->id,
                ]);
            }


            $qualities = collect($request->qualities);
            foreach($qualities as $item){
                $newQuality = Quality::create([
                    'quality' => $item['quality'],
                    'candidate_id' => $candidate->id,
                ]);
            }

            $specialities = collect($request->specialities);
            foreach($specialities as $item){

                    $newCategoryCandidate = CategoryCandidate::create([
                        'category_id' => $item['speciality'],
                        'candidate_id' => $candidate->id,
                    ]);

            }
            $newMotivation = Motivation::create([
                'motivation' => $request->motivation,
                'candidate_id' => $candidate->id,
            ]);

            $candidate->update([
                'last_name'              => $request->last_name  ,
                'first_name'             => $request->first_name  ,
                'email'                 => $request->email  ,
                'gender'                => $request->gender  ,
                'mobile_number'          =>  $request->mobile_number ,
                'address'            => $request->address  ,
                'date_of_birth'           => $request->date_of_birth  ,
                'nationality'           => $request->nationality  ,
                'cv_created'           => 1,


            ]);



            DB::commit();
            return response()->json([
                'candidate' => $candidate,
                'message' => 'cv created and candidate updated successfully',

            ], 201);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    /**
     * show cv
     */
    public function show(Candidate $candidate)
    {
      try {

        DB::beginTransaction();

        $candidate = Candidate::where('id' , Auth::user()->userable_id)->first();
        $degrees = Degree::where('candidate_id' , $candidate->id)->get();
        $projects = AcademicProject::where('candidate_id' , $candidate->id)->get();
        $experiences = ProfessionalExperience::where('candidate_id' , $candidate->id)->get();
        $certifications = Certification::where('candidate_id' , $candidate->id)->get();
        $competences = Competence::where('candidate_id' , $candidate->id)->get();
        $languages = Language::where('candidate_id' , $candidate->id)->get();
        $qualities = Quality::where('candidate_id' , $candidate->id)->get();
        $specialities = CategoryCandidate::where('candidate_id' , $candidate->id)->get();
        $motivation = Motivation::where('candidate_id' , $candidate->id)->first();
        return response()->json([
            'candidate' => $candidate,
            'degrees' => $degrees,
            'projects' => $projects,
            'certifications' => $certifications,
            'experiences' => $experiences,
            'competences' => $competences,
            'languages' => $languages,
            'qualities' => $qualities,
            'specialities' => $specialities,
            'motivation' => $motivation,
        ],200);
      } catch (\Throwable $exception) {
        DB::rollBack();
        return $exception->getMessage();
      }

    }

   /* update cv */
    public function update(StoreCvRequest $request)
    {
        try {

            DB::beginTransaction();


            $candidate = Candidate::where('id' , Auth::user()->userable_id)->first();

            $degrees = collect($request->degrees);
            foreach ($degrees as $item) {

                $Degree = Degree::where('id' , $item['id'] )->update([
                    'degree_title' => $item['degree_title'],
                    'organism' => $item['organism'],
                    'organism_city' => $item['organism_city'],
                    'degree_start_date' => $item['degree_start_date'],
                    'degree_end_date' => $item['degree_end_date'],
                    'degree_description' => $item['degree_description'],
                    'candidate_id' => $candidate->id,
                ]);
            }

            $projects = collect($request->projects);
            foreach ( $projects as $item){

                $AcademicProject = AcademicProject::where('id' , $item['id'] )->update([
                    'project_title' => $item['project_title'],
                    'project_description' => $item['project_description'],
                    'master_project' => $item['master_project'],
                    'project_start_date' => $item['project_start_date'],
                    'project_end_date' => $item['project_end_date'],
                    'candidate_id' => $candidate->id,
                ]);
            }

            $experiences = collect($request->experiences);
            foreach($experiences as $item){
            
                $ProfessionalExperience = ProfessionalExperience::where('id' , $item['id'] )->update([
                    'experience_title' => $item['experience_title'],
                    'enterprise_name' => $item['enterprise_name'],
                    'enterprise_city' => $item['enterprise_city'],
                    'enterprise_address' => $item['enterprise_address'],
                    'experience_start_date' => $item['experience_start_date'],
                    'experience_end_date' => $item['experience_end_date'],
                    'experience_description' => $item['experience_description'],

                ]);
            }

            $certifications = collect($request->certifications);
            foreach($certifications as $item){
                $Certification = Certification::where('id' , $item['id'] )->update([
                    'certification_name' => $item['certification_name'],
                    'issuing_agency' => $item['issuing_agency'],
                    'issue_date' => $item['issue_date'],
                    'expiration_date' => $item['expiration_date'],
                    'degree_id' => $item['degree_id'],
                    'degree_url' => $item['degree_url'],

            ]);
           }
           $competences = collect($request->competences);
           foreach ( $competences as $item){
               $Competence = Competence::where('id' , $item['id'] )->update([
                'competence' => $item['competence'],
                'competence_description' => $item['competence_description'],
                'candidate_id' => $candidate->id,
               ]);
           }



          $languages = collect($request->languages);
            foreach($languages as $item){
                $Language = Language::where('id' , $item['id'] )->update([
                    'language' => $item['language'],
                    'candidate_id' => $candidate->id,
                ]);
            }


              $qualities = collect($request->qualities);
            foreach($qualities as $item){
                $Quality = Quality::where('id' , $item['id'] )->update([
                    'quality' => $item['quality'],
                    'candidate_id' => $candidate->id,
                ]);
            }
            $motivation = Motivation::where('candidate_id' , $candidate->id )->update([
                'motivation' => $request->motivation,
                'candidate_id' => $candidate->id,
            ]);
           $candidate->update([
                'last_name'              => $request->last_name  ,
                'first_name'             => $request->first_name  ,
                'email'                 => $request->email  ,
                'gender'                => $request->gender  ,
                'mobile_number'          =>  $request->mobile_number ,
                'address'            => $request->address  ,
                'date_of_birth'           => $request->date_of_birth  ,
                'nationality'           => $request->nationality  ,
                'cv_created'           => 1,


            ]);

            $specialities = collect($request->specialities);
            foreach($specialities as $item){

                    $speciality = CategoryCandidate::where('id' , $item['id'] )->update([
                        'category_id' => $item['speciality'],
                        'candidate_id' => $candidate->id,
                    ]);


            }
            DB::commit();
            return response()->json([
                'candidate' => $candidate,
                'degrees' => $degrees,
                'projects' => $projects,
                'certifications' => $certifications,
                'experiences' => $experiences,
                'competences' => $competences,
                'languages' => $languages,
                'qualities' => $qualities,
                'motivation' => $motivation,
                'specialities' => $specialities,
                'message' => 'cv  updated successfully',

            ], 201);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    
    
}
