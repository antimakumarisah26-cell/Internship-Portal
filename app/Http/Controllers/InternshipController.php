<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Internship;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class InternshipController extends Controller
{
    //
    public function index(){
        return view('internship.internship');
    }
    public function store(Request $request){
        try{

        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'required_skills'=>'required',
            'location'=>'required',
            'deadline'=>'required'
        ]);
        DB::beginTransaction();
       $internship=new Internship();
       $internship->title=$request->title;
       $internship->description=$request->description;
       $internship->required_skills=$request->required_skills;
       $internship->location=$request->location;
       $internship->deadline=$request->deadline;
       $user = Auth::user();
       if(!$user){
           DB::rollback();
           return redirect()->back()->with("error","You must be signed in to create an internship");
       }
       $company = $user->company;
       if(!$company){
           DB::rollback();
           return redirect()->back()->withInput()->with("error","You must create a company profile before posting an internship");
       }
       $internship->company_id = $company->id;
       $internship->save();
        DB::commit();

        return redirect()->back()->with("success","internship created successfully");

        }catch(\Exception $e){
            DB::rollBack();
            \Log::error($e->getMessage());
            return redirect()->back()->with("error",$e->getMessage());
        }

    }
    public function edit(string $id){
        $internship = Internship::where('company_id',Auth::user()->company->id)->where('id',$id)->first();
        return view('internship.edit',compact('internship'));
    }

  public function update(Request $request, $id)
{
    try {
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'required_skills' => 'required|string',
            'location' => 'required|string|max:255',
            'deadline' => 'required|date',
        ]);

        DB::beginTransaction();

        // Find internship belonging to this company only
        $internship = Internship::where('company_id', Auth::user()->company->id)
            ->where('id', $id)
            ->first();

        if (!$internship) {
            DB::rollback();
            return redirect()->route('company.dashboard')->with("error", "Internship not found or you don't have permission to edit it");
        }

        // Update internship
        $internship->title = $request->title;
        $internship->description = $request->description;
        $internship->required_skills = $request->required_skills;
        $internship->location = $request->location;
        $internship->deadline = $request->deadline;
        $internship->save();

        DB::commit();

        return redirect()->route('company.dashboard')->with("success", "Internship updated successfully");

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error($e->getMessage());
        return redirect()->back()->with("error", $e->getMessage());
    }
}

    public function viewInternships(){
        $internships = Internship::with('company','application')->withCount('application')->get();
        // return view('student.internship.index',compact('internships'));

        return view('student.internship.index',['internships'=>$internships]);
    }
    public function apply($id){
        //logic to apply for internship
        $internship = Internship::find($id);
        if(!$internship){
            return redirect()->back()->with("error","Internship not found");
        }
        //check if student has already applied
        $user = Auth::user();
        if(!$user){
            return redirect()->back()->with("error","You must be signed in to apply for an
    internship");
        }
        $student = Auth::user()->student->id;
        if(!$student){
            return redirect()->back()->with("error","You must create a student profile before applying for an internship");
        }
        $application = DB::table('application')->where('student_id',$student)->where('internship_id',$internship->id)->first();
        if($application){
            return redirect()->back()->with("error","You have already applied for this internship");
        }
        DB::table('application')->insert([
            'student_id'=>$student,
            'internship_id'=>$internship->id,
            'status'=>'pending',
            'applied_at'=>now(),
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        return redirect()->back()->with("success","Application submitted successfully");
    }
    public function create()
{
    return view('internship.internship');
}
}