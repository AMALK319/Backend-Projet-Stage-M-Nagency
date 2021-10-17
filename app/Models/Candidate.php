<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'gender',
        'mobile_number',
        'date_of_birth',
        'nationality',
        'photo_path',
        'address',
        'token',
        'cv_created',
     
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function representatives()
    {
        return $this->belongsToMany(CompanyRepresentative::class);
    }



    public function academic_projects()
    {
        return $this->belongsToMany(AcademicProject::class);
    }

    public function professional_experiences()
    {
        return $this->belongsToMany(ProfessionalExperience::class);
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class);
    }

    public function degrees()
    {
        return $this->belongsToMany(Degree::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

    public function certifications()
    {
        return $this->belongsToMany(Certification::class);
    }

    public function qualities()
    {
        return $this->belongsToMany(Quality::class);
    }

    public function motivations()
    {
        return $this->belongsToMany(Motivation::class);
    }

    protected static function boot()
    {
        parent::boot();

       static::deleting(function ($id) {

            AcademicProject::where('candidate_id', $id)->delete();
           /*  Competence::where('candidate_id', $candidate->id)->delete();
            Certification::where('candidate_id', $candidate->id)->delete();
            Degree::where('candidate_id', $candidate->id)->delete();
            Language::where('candidate_id', $candidate->id)->delete();
            Motivation::where('candidate_id', $candidate->id)->delete();
            ProfessionalExperience::where('candidate_id', $candidate->id)->delete();
            Quality::where('candidate_id', $candidate->id)->delete();
            Conversation::where('candidate_id', $candidate->id)->delete();
            Consultation::where('candidate_id', $candidate->id)->delete(); */

            User::where('userable_id', $id && 'userable_type', 'App\Models\Candidate')->delete();
        });
    }
}


