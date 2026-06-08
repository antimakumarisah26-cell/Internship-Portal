<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class StudentController extends Controller
{
    //
    public function register(){
        return view("student.register");
    }

    public function store(Request $request){
        try{
            $request->validate([
                'name'=>"required",
                "email"=> "required|email|unique:users",
                "password"=> "required|min:4",
                "phone_number"=>"required|unique:students",
                "college_name"=>"required",
                "faculty"=>"required",
                "semester"=>"required",
                "skills"=>"nullable",
            ]);
            DB::beginTransaction();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $student = new Student();
        $student->phone_number = $request->phone_number;
        $student->college_name = $request->college_name;
        $student->faculty = $request->faculty;
        $student->semester = $request->semester;
        $student->skills = $request->skills;
        $student->user_id = $user->id;
        $student->save();

        DB::commit();

        return redirect()->back()->with("success","Student registered successfully");

        }catch(\Exception $e){
            DB::rollBack();
            \Log::error($e->getMessage());
            return redirect()->back()->with("error",$e->getMessage());
        }
    }

    public function uploadResume(Request $request){
        try{
            $validated = $request->validate([
                "resume"=>"required|file|mimes:pdf,doc,docx,jpg,png|max:2048"
            ]);

            $user = auth()->user();
            if(!$user || !$user->student){
                return redirect()->back()->with("error","You must be logged in as a student to upload a resume");
            }

            $resumePath = $request->file('resume')->store('resumes', 'public');
            $student = $user->student;
            $student->resume = $resumePath;
            $student->save();

            return redirect()->back()->with("success","Resume uploaded successfully");

        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return redirect()->back()->with("error",$e->getMessage());
        }
    }
    public function uploadProfile(Request $request){
        try{
            $validated = $request->validate([
                "profile"=>"required|file|mimes:jpg,png|max:2048"
            ]);

            $user = auth()->user();
            if(!$user || !$user->student){
                return redirect()->back()->with("error","You must be logged in as a student to upload a profile");
            }

            $profilePath = $request->file('profile')->store('profile', 'public');
            $student = $user->student;
            $student->profile_picture = $profilePath;
            $student->save();

            return redirect()->back()->with("success","profile uploaded successfully");

        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return redirect()->back()->with("error",$e->getMessage());
        }
    }
}
