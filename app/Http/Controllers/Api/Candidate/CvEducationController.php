<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Http\Requests\CvEducationRequest;
use App\Models\AcademicProject;
use App\Models\Candidate;
use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CvEducationController extends Controller
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
    public function store(CvEducationRequest $request, Candidate $candidate)
    {
        try {

            DB::beginTransaction();

            $newDegree = Degree::create([
                'degree_title' => $request->degree_title,
                'organism' => $request->organism,
                'organism_city' => $request->organism_city,
                'degree_start_date' => $request->degree_start_date,
                'degree_end_date' => $request->degree_end_date,
                'degree_description' => $request->degree_description,
                'candidate_id' => $candidate->id,
            ]);
            $newAcademicProject = AcademicProject::create([
                'project_title' => $request->project_title,
                'project_description' => $request->project_description,
                'master_project' => $request->master_project,
                'project_start_date' => $request->project_start_date,
                'project_end_date' => $request->project_end_date,
                'candidate_id' => $candidate->id,
            ]);



            DB::commit();
            return response()->json([
                'degree' => $newDegree,
                'academic_project' => $newAcademicProject,
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
