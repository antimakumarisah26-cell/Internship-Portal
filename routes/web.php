<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\ApplicationController;
// In routes/web.php
use App\Http\Controllers\ApplicantController;



Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'student'], function () {
    Route::get('/register/', [StudentController::class, 'register'])->name('register');
    Route::post('/register/store',[StudentController::class,'store'])->name('student.store');
});
Route::group(['prefix'=>'company'],function(){
    Route::get('/register', [CompanyController::class, 'register']);
    Route::post('/register',[CompanyController::class,'store'])->name('company.store');
});
Route::view('/login','login')->middleware('guest');
Route::post("/login",[LoginController::class,'login'])->name('login');
Route::get('/dashboard', function () {
    return view('login');
    })->name('dashboard')->middleware('auth');
Route::group(['prefix'=>'internship'],function(){
    Route::get('/',[InternshipController::class,'index']);
    Route::post('/internship',[InternshipController::class,'store'])->name('internship.store');

})->middleware('auth');
Route::get('/company/dashboard',[CompanyController::class,'dashboard'])->name('company.dashboard')->middleware('auth');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('student/internships',[InternshipController::class,'viewInternships'])->name('internship.view')->middleware('auth');
Route::post('student/apply/{internship}',[InternshipController::class,'apply'])->name('student.apply')->middleware('auth');
Route::post('resume/upload',[StudentController::class,'uploadResume'])->name('resume.upload')->middleware('auth');

Route::get('resume', function(){
    return view('student.resume');
})->name('resume.upload.page')->middleware('auth');  // ← Name add kiya
Route::get('student/dashboard',function(){
    return view('student.dashboard');
})->name('student.dashboard')->middleware('auth');
Route::get('/internship/create', [InternshipController::class, 'create'])->name('internship.create')->middleware('auth');
Route::get('internship/edit/{id}',[InternshipController::class,'edit'])->name('internship.edit');
Route::put('internship/update/{id}',[InternshipController::class,'update'])->name('internship.update');

Route::get('profile', function(){
    return view('student.profile');
})->name('profile.upload.page')->middleware('auth');
Route::post('profile/upload',[StudentController::class,'uploadProfile'])->name('profile.upload')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    // Company routes
    Route::get('/company/internship/{id}/applicants', [ApplicantController::class, 'viewApplicants'])->name('company.applicants');
    Route::put('/company/application/{id}/status', [ApplicantController::class, 'updateStatus'])->name('company.application.status');
    Route::get('/company/application/{id}/view', [ApplicantController::class, 'viewApplication'])->name('company.application.view');
});
