<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UserApiController extends Controller
{
    //
        public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:4',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors(),
                ], 422);
            }
            DB::beginTransaction();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();



        DB::commit();

        return "Added ";

        }catch(\Exception $e){
            DB::rollBack();

            return "Failed";
        }
    }
    public function update(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:users,id',
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $request->id,
                'password' => 'nullable|min:4',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors(),
                ], 422);
            }

            $user = User::find($request->id);
            if (! $user) {
                return response()->json([
                    'error' => true,
                    'message' => 'User not found.',
                ], 404);
            }

            DB::beginTransaction();
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            DB::commit();

            return response()->json([
                'error' => false,
                'result' => 'student updated',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => true,
                'message' => 'Failed to update user.',
            ], 500);
        }
    }
    function delete($id){
       $user = User::destroy($id);
       if($user){
        return ['result'=>"user record deleted"];}
        else{
            return ["result"=> "user not record deleted"];
        }
    }
    
}
