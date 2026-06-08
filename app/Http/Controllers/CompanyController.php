<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Internship;

class CompanyController extends Controller
{
 public function register(){
    return view("company.register");
 }
 public function store(Request $request){
    try{
        $request->validate([
            'company_name'=>"required",
            "email"=> "required|email|unique:users",
            "password"=> "required|min:4",
            "phone_number"=>"required|unique:companies",
            "website"=>"required",
            "description"=>"required",
            "location"=>"required",
        ]);
        DB::beginTransaction();
        $user = new User();
        $user->name = $request->company_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $company = new Company();
        $company->company_name = $request->company_name;
        $company->email = $request->email;
        $company->phone_number = $request->phone_number;
        $company->website = $request->website;
        $company->description = $request->description;
        $company->location = $request->location;
        $company->user_id = $user->id;
        $company->save();

        DB::commit();

        return redirect()->back()->with("success","Company registered successfully");

    }catch(\Exception $e){
        DB::rollback();
        \Log::error($e->getMessage());
        return redirect()->back()->with("error",$e->getMessage());
    }
 }    
public function dashboard()
    {
        // Get company ID from logged in user
        $companyId = Auth::user()->company->id;
        
        // Get all internships of this company with application count
        $internships = Internship::where('company_id', $companyId)
            ->withCount('application')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Total applications received for all internships
        $totalApplications = Application::whereHas('internship', function($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->count();
        
        // Total unique students who applied
        $totalUniqueStudents = Application::whereHas('internship', function($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->distinct('student_id')->count('student_id');
        
        // Internship with most applicants
        $topInternship = Internship::where('company_id', $companyId)
            ->withCount('application')
            ->orderBy('application_count', 'desc')
            ->first();
        
        return view('company.dashboard', compact(
            'internships', 
            'totalApplications', 
            'totalUniqueStudents',
            'topInternship'
        ));
    } 
 public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}
} 
    