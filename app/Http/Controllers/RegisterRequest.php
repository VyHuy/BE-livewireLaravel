<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends Controller
{
    public $password;
    public function register(Request $req)
    {
        $req->validate([
            'name'        => 'required|min:3',
            'email'       => 'required|unique:users|email|max:255|regex:/(.*)@gmail\.com/i',
            'password'    => 'required|min:8|same:confirmPass',
            'confirmPass' => 'required',
        ]);
        $hashPass = Hash::make($req->password);
        $req      = User::create([
            'name'     => $req->name,
            'email'    => $req->email,
            'password' => $hashPass,
            'role'     => 1000,
        ]);
            return response()->json([
                'status' =>'200',
                'message' => 'success',
            ]);
        
    }
    public function login(Request $req)
    {
        $user = User::where('email', $req->email)->first();
        $req->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        if(!$user || !Hash::check($req->password,$user->password)) {
            return response()->json([
                'status' =>'400',
                'message' =>'Email or password is not correct',
            ]);
        }else{
               return response()->json([ 
                'status' =>'200',
                'message' =>'success'
            ]);
            
        }
    }
}
