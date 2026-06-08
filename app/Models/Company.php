<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable=[
        "company_name",
        "email",
        "phone_number",
        "website",
        "description",
        "location",
        "user_id"
    ];

    public function user(){
        return $this->hasOne(User::class,"id","user_id");
    }
}
