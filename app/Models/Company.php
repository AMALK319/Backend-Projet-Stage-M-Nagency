<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_address',
        'representative_id',
    ];

    public function representatives()
    {
        return $this->belongsTo(CompanyRepresentative::class);
    }
}
