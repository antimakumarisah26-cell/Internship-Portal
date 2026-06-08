<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    //
    protected $table = "internships";
        protected $fillable=[
        "title",
        "description",
        "required_skills",
        "location",
        "deadline",
        "company_id"
    ];

    protected $casts=[
        "deadline"=>"date",
        "description"=>"string"
    ];
    
    public function company(){
        return $this->belongsTo(Company::class,"company_id");
    }
    public function application(){
        return $this->hasMany(Application::class);
    }
}


