<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;


class CompanyRepresentative extends Model
{
    use HasApiTokens,HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile_number',
        'mission',

    ];

    public function candidates()
    {
        return $this->belongsToMany(candidates::class);
    }

    public function companies()
    {
        return $this->belongsToMany(companies::class);
    }

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($company_representative) {

            Company::where('representative_id', $company_representative->id)->delete();
            Conversation::where('representative_id', $company_representative->id)->delete();
            Consultation::where('representative_id', $company_representative->id)->delete();

            User::where('userable_id', $company_representative->id)->where( 'userable_type', 'App\Models\CompanyRepresentative')->delete();
        });
    }
}
