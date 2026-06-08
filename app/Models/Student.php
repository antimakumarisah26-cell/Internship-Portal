<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable=[
        "phone_number",
        "college_name",
        "faculty",
        "semester",
        "skills",
        "user_id"
    ];
    public function user(){
        return $this->hasOne(User::class,"id","user_id");
    }

    public function application(){
        return $this->hasOne(Application::class,"student_id","id");
    }
    public function hasAppliedTo($internshipId)
    {
        return $this->application()
            ->where('internship_id', $internshipId)
            ->exists();
    }
}
