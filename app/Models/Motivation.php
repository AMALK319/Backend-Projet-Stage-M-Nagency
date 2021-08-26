<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motivation extends Model
{
    use HasFactory;

    protected $fillable = [
        'motivation',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
