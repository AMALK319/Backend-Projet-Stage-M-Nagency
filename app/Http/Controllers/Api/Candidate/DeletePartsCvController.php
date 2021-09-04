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

class DeletePartsCvController extends Controller
{
   //supprimer une formation du cv
    public function destroyDegree(Request $request)
    {
        try { 
        $degree = Degree::where('id' , $request->id)->delete();
        $candidate = Candidate::where('id' , Auth::user()->userable_id)->first();
        $degrees = Degree::where('candidate_id' , $candidate->id)->get(); 
        return response()->json([
            'degrees' => $degrees,
            'message' => 'degree  deleted successfully',
        ], 200);
        } 
        catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }
    //supprimer un projet du cv 
    public function destroyProject(Request $request)
    {
        try { 
         
        $project = AcademicProject::where('id' , $request->id)->delete();
        $candidate = Candidate::where('id' , Auth::user()->userable_id)->first();
        $projects = AcademicProject::where('candidate_id' , $candidate->id)->get(); 
        return response()->json([
            'projects' => $projects,
            'message' => 'project  deleted successfully',
        ], 200);
        } 
        catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }
//supprimer une compétence du cv
    public function destroyCompetence(Request $request)
    {
        try { 
        $competence = Competence::where('id' , $request->id)->delete();
        $candidate = Candidate::where('id' , Auth::user()->userable_id)->first();
        $competences = Competence::where('candidate_id' , $candidate->id)->get(); 
        return response()->json([
            'competences' => $competences,
            'message' => 'competence  deleted successfully',
        ], 200);
        } 
        catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }
//supprimer une langue du cv
    public function destroyLanguage(Request $request)
    {
        try { 
        $language = Language::where('id' , $request->id)->delete();
        $candidate = Candidate::where('id' , Auth::user()->userable_id)->first();
        $languages = Language::where('candidate_id' , $candidate->id)->get(); 
        return response()->json([
            'languages' => $languages,
            'message' => 'language  deleted successfully',
        ], 200);
        } 
        catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }
    //supprimer une qualité du cv 
    public function destroyQuality(Request $request)
    {
        try { 
        $quality = Quality::where('id' , $request->id)->delete();
        $candidate = Candidate::where('id' , Auth::user()->userable_id)->first();
        $qualities = Quality::where('candidate_id' , $candidate->id)->get(); 
        return response()->json([
            'qualities' => $qualities,
            'message' => 'quality  deleted successfully',
        ], 200);
        } 
        catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }
}

