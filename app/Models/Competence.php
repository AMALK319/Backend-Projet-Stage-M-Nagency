<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $fillable = [
        'competence',
        'competence_description',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
