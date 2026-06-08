<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = "application";
    protected $fillable=[
        "student_id",
        "internship_id",
        "status",
        "applied_at"
    ];

    public function student(){
        return $this->belongsTo(Student::class,"student_id");
    }

    public function internship(){
        return $this->belongsTo(Internship::class,"internship_id");
    }
}
