<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalExperience extends Model
{
    use HasFactory;

    protected $fillable = [

        'experience_title' ,
        'enterprise_name' ,
        'enterprise_city' ,
        'enterprise_address' ,
        'experience_start_date' ,
        'experience_end_date' ,
        'experience_description' ,

    ];


    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
