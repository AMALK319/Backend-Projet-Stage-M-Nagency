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
   
    public  $candidate;
    public function __construct() { 
         this.candidate == candidate::where('id' , Auth::user()->userable_id)->first();
    }

   //supprimer une formation du cv
    public function destroyDegree(Request $request)
    {
        try { 
        $degree = Degree::where('id' , $request->id)->delete();
        $degrees = Degree::where('candidate_id' , $candidate->id)->get(); 
        return response()->json([
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
        $projects = AcademicProject::where('candidate_id' , $candidate->id)->get(); 
        return response()->json([
            'message' => 'project  deleted successfully',
        ], 200);
        } 
        catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }
     //supprimer une experience du cv 
     public function destroyExperience(Request $request)
     {
         try { 
          
         $experience = ProfessionalExperience::where('id' , $request->id)->delete();
         $experiences = ProfessionalExperience::where('candidate_id' , $candidate->id)->get(); 
         return response()->json([     
             'message' => 'experience  deleted successfully',
         ], 200);
         } 
         catch (\Throwable $exception) {
             return $exception->getMessage();
         }
     }
      //supprimer une certification du cv 
    public function destroyCertification(Request $request)
    {
        try { 
         
        $certification = Certification::where('id' , $request->id)->delete();
        $certifications = Certification::where('candidate_id' , $candidate->id)->get(); 
        return response()->json([
            'message' => 'certification  deleted successfully',
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
        $competences = Competence::where('candidate_id' , $candidate->id)->get(); 
        return response()->json([
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
        $languages = Language::where('candidate_id' , $candidate->id)->get(); 
        return response()->json([
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
        $qualities = Quality::where('candidate_id' , $candidate->id)->get(); 
        return response()->json([
            'message' => 'quality  deleted successfully',
        ], 200);
        } 
        catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }
}

