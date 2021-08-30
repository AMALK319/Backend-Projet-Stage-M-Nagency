<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [

        'certification_name' ,
        'issuing_agency' ,
        'issue_date' ,
        'expiration_date' ,
        'degree_id' ,
        'degree_url' ,
        'candidate_id',
    ];


    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
