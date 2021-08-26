<?php

namespace App\Http\Controllers\Api\Candidate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CvSkillsRequest;
use App\Models\Candidate;
use App\Models\Competence;
use App\Models\Language ;
use App\Models\Motivation;
use App\Models\Quality;
use Illuminate\Support\Facades\DB;


class CvSkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CvSkillsRequest $request, Candidate $candidate)
    {

        try {
            DB::beginTransaction();

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

            DB::commit();
            return response()->json([
                'data' => [
                      'competence' => $newCompetence,
                      'language' => $newLanguage,
                      'motivation' => $newMotivation,
                      'quality' => $newQuality,
                ],
                'message' => 'cv_skills created'
            ],201);


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
