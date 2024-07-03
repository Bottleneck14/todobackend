<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserControl extends Controller
{
    public function registrasi(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required'
        ]);

        $data=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        return response()->json([
            'message'=>'data dibuat'
        ]);
    }

    public function login(Request $request){

        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $user = User::firstWhere('email',$request->email);

        if(Auth::attempt($request->only(['email','password']))){
            $token = $user->createToken('apiToken')->plainTextToken;
            return response()->json([
                "message"=>"berhasil login",
                "token"=>$token
            ]);
        }else{
            return response()->json([
                "message"=>"gagal login"
            ]);
        }
    }

    public function logout(Request $request){
        $user = $request->user();

        if ($user) {
            $user->currentAccessToken()->delete();
            return response()->json('Logged out successfully', 200);
        } else {
            return response()->json('No user is currently logged in', 401);
        }
    }

    public function getUser(){
        $data=Auth::user();

        return response()->json($data);
    }
}
