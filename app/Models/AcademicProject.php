<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_title' ,
        'project_description' ,
        'master_project' ,
        'project_start_date' ,
        'project_end_date' ,
    ];

    public function candidate()
    {

        return $this->belongsTo(Candidate::class);
    }
}

