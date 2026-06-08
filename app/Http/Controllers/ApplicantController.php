<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internship;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{
    // View all applicants for a specific internship
    public function viewApplicants($internshipId)
    {
        // Check if internship belongs to logged-in company
        $internship = Internship::where('company_id', Auth::user()->company->id)
            ->where('id', $internshipId)
            ->firstOrFail();
        
        // Get all applications with student details
        $applicants = Application::with('student','student.user')
            ->where('internship_id', $internshipId)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Statistics
        $totalApplicants = $applicants->count();
        $pendingCount = $applicants->where('status', 'pending')->count();
        $shortlistedCount = $applicants->where('status', 'shortlisted')->count();
        $rejectedCount = $applicants->where('status', 'rejected')->count();
        $hiredCount = $applicants->where('status', 'hired')->count();
        
        return view('company.applicants', compact(
            'internship', 
            'applicants', 
            'totalApplicants',
            'pendingCount',
            'shortlistedCount', 
            'rejectedCount',
            'hiredCount'
        ));
    }
    
    // Update application status
    public function updateStatus(Request $request, $applicationId)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,shortlisted,rejected,hired'
            ]);
            
            DB::beginTransaction();
            
            $application = Application::whereHas('internship', function($query) {
                $query->where('company_id', Auth::user()->company->id);
            })->findOrFail($applicationId);
            
            $application->status = $request->status;
            $application->save();
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Application status updated successfully'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    // View single application details
    public function viewApplication($applicationId)
    {
        $application = Application::with(['student', 'internship','student.user'])
            ->whereHas('internship', function($query) {
                $query->where('company_id', Auth::user()->company->id);
            })
            ->findOrFail($applicationId);
        
        return view('company.application-detail', compact('application'));
    }
}