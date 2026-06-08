<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request){
        
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        // Attempt login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            
            // Get the authenticated user
            $user = Auth::user();
            
            // Redirect based on user type
            if ($user->student) {
                return redirect()->route('student.dashboard'); // You need to create this route
            } elseif ($user->company) {
                return redirect()->route('company.dashboard');
            }
            
            // Default redirect
            return redirect('/dashboard');
        }
        
        return redirect('/login')->with('error', 'Invalid credentials');
    }

    public function logout(){
        Auth::logout();
        session()->flush();
        return redirect('/login');
    }
}