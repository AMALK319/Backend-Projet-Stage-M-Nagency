<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Http\Requests\Candidate\StoreCvRequest;
use App\Models\AcademicProject;
use App\Models\Candidate;
use App\Models\Degree;
use App\Models\Competence;
use App\Models\Language ;
use App\Models\Motivation;
use App\Models\Quality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCvRequest $request, Candidate $candidate)
    {
        try {

            DB::beginTransaction();

            $degrees = collect($request->degrees);


            foreach ( $degrees as $item){
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

         /*    $projects = collect($request->projects);
            foreach ( $projects as $item){
                $newAcademicProject = AcademicProject::create([
                    'project_title' => $item->project_title,
                    'project_description' => $item->project_description,
                    'master_project' => $item->master_project,
                    'project_start_date' => $item->project_start_date,
                    'project_end_date' => $item->project_end_date,
                    'candidate_id' => $candidate->id,
                ]);
            } */
/*
            $experiences = collect($request->experiences);
            foreach($experiences as $item){
                $newProfessionalExperience = ProfessionalExperience::create([
                    'experience_title' => $item->experience_title,
                    'enterprise_name' => $item->enterprise_name,
                    'enterprise_city' => $item->enterprise_city,
                    'enterprise_address' => $item->enterprise_address,
                    'experience_start_date' => $item->experience_start_date,
                    'experience_end_date' => $item->experience_end_date,
                    'experience_description' => $item->experience_description,

                ]);
            }

            $certifications = collect($request->certifications);
            foreach($certifications as $item){
            $newCertification = Certification::create([
                'certification_name' => $item->certification_name,
                'issuing_agency' => $item->issuing_agency,
                'issue_date' => $item->issue_date,
                'expiration_date' => $item->expiration_date,
                'degree_id' => $item->degree_id,
                'degree_url' => $item->degree_url,

            ]);
           } */
/*
            $newCompetence = Competence::create([
                'competence' => $request->competence,
                'competence_description' => $request->competence_description,
                'candidate_id' => $candidate->id,
            ]);

            $newLanguage = Language::create([
                'language' => $request->language,
                'candidate_id' => $candidate->id,
            ]);

            $newMotivation = Motivation::create([
                'motivation' => $request->motivation,
                'candidate_id' => $candidate->id,
            ]);

            $newQuality = Quality::create([
                'quality' => $request->quality,
                'candidate_id' => $candidate->id,
            ]);
 */


            DB::commit();
            return response()->json([
                'degrees' =>  $request->degrees ,

            ], 201);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
