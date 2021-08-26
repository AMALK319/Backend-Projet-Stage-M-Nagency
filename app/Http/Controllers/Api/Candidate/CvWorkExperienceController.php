<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Http\Requests\CvWorkExperienceRequest;
use App\Models\Candidate;
use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\ProfessionalExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CvWorkExperienceController extends Controller
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
    public function store(CvWorkExperienceRequest $request)
    {
        try {

            DB::beginTransaction();

            $newProfessionalExperience = ProfessionalExperience::create([
                'experience_title' => $request->experience_title,
                'enterprise_name' => $request->enterprise_name,
                'enterprise_city' => $request->enterprise_city,
                'enterprise_address' => $request->enterprise_address,
                'experience_start_date' => $request->experience_start_date,
                'experience_end_date' => $request->experience_end_date,
                'experience_description' => $request->experience_description,

            ]);

            $newCertification = Certification::create([
                'certification_name' => $request->certification_name,
                'issuing_agency' => $request->issuing_agency,
                'issue_date' => $request->issue_date,
                'expiration_date' => $request->expiration_date,
                'degree_id' => $request->degree_id,
                'degree_url' => $request->degree_url,

            ]);

            DB::commit();

            return response()->json([
                'professional_experience' =>  $newProfessionalExperience,
                'certification' => $newCertification,
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
