<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryCandidate extends Pivot
{
    protected $fillable = [
        'category_id',
        'candidate_id',
    ];
}