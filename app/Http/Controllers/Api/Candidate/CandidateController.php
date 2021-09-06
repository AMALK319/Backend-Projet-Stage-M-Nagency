<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Candidate\StoreCandidateRequest;
use App\Models\Candidate;
use App\Models\Degree;
use App\Models\AcademicProject;
use App\Models\Competence;
use App\Models\Language;
use App\Models\Quality;
use App\Models\CategoryCandidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $candidates = Candidate::all();

            foreach( $candidates as $candidate){
                $user=User::where('userable_id' , $candidate->id)->first();
                $candidate->token = $user->token;
                $candidate->specialities = CategoryCandidate::where('candidate_id' , $candidate->id)->get(); 
            }
            return response()->json([
                'candidates' => $candidates,
               

            ],200);

        } catch (\Throwable $exception) {

            return $exception->getMessage();
        }
    }

    public function showSpecialCandidates($category)
    {

        try {
            $candidates = collect();
            $items = CategoryCandidate::where('category_id' , $category)->get();
            foreach( $items as $item){
                $candidate = Candidate::where('id' , $item['candidate_id'])->first();
                $candidates->push($candidate);
            }
            foreach( $candidates as $candidate){
                $user=User::where('userable_id' , $candidate->id)->first();
                $candidate->token = $user->token;
                $candidate->specialities = CategoryCandidate::where('candidate_id' , $candidate->id)->get(); 
            }
            return response()->json([
                'candidates' => $candidates,
               

            ],200);

        } catch (\Throwable $exception) {

            return $exception->getMessage();
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(StoreCandidateRequest $request)
    {
        try {

            DB::beginTransaction();
            $attributes = $request->validated();
            unset($attributes['email']);
            unset($attributes['password']);
            $newCandidate = Candidate::create($attributes);

            $newUser = User::create([
                'email'             =>  $request->email,
                'token'             =>  (string) Str::uuid(),
                'password'          =>  bcrypt($request->password),
                'userable_type'     =>  Candidate::class,
                'userable_id'       => $newCandidate->id,
            ]);
            $token = $newUser->createToken('API Token')->accessToken;

            Mail::to($request->get('email'))->send(new EmailVerification($newUser));

            DB::commit();
            return response()->json([
                'candidate' => $newCandidate->with(['user'])->first(),
                'message' => 'candidate created',
                'token' => $token,
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
    public function show(Candidate $candidate , User $user)
    {
        try {
            $current = Auth::user();
            $candidate = Candidate::where('id' , $current->userable_id)->first();
            return response()->json([
                'candidate' => $candidate,
                
            ],200);

        } catch (\Throwable $exception) {

            return $exception->getMessage();
        }
    }

    public function showCandidate($token){

        try {
            $user = User::where('token', $token)->first();
            $candidate = Candidate::where('id' , $user->userable_id)->first();
            $degrees = Degree::where('candidate_id' , $candidate->id)->get();
            $projects = AcademicProject::where('candidate_id' , $candidate->id)->get();
            $competences = Competence::where('candidate_id' , $candidate->id)->get();
            $languages = Language::where('candidate_id' , $candidate->id)->get();
            $qualities = Quality::where('candidate_id' , $candidate->id)->get();
            $specialities = CategoryCandidate::where('candidate_id' , $candidate->id)->get(); 
            return response()->json([
                'candidate' => $candidate,
                'degrees' => $degrees,
                'projects'=> $projects,
                'competences' => $competences,
                'languages' => $languages,
                'qualities' => $qualities,
                'specialities' => $specialities,
            ],200);

        } catch (\Throwable $exception) {

            return $exception->getMessage();
        }
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
        
    }
}
