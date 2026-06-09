<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Http\Controllers\UserApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/student' ,function () {
    return Student::all();
});
Route::post('/add',[UserApiController::class,'store']);

Route::put('/update',[UserApiController::class,'update']);
Route::delete('/delete/{id}',[UserApiController::class,'delete']);