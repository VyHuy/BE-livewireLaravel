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
        if($req->validate() == true){
            return response()->json([
                'message' => 'success',
            ]);
        }else{
            $req->name    = '';
            $req->email    = '';
            $req->password = '';
            return response()->json([
                'message' => 'Fail',
            ]);
        }
        
    }
    public function login(Request $req)
    {
        $user = User::find($req->email);
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {

            
            return response()->json([
                'message' =>'success'
            ]);
        } else {
            $req->email    = '';
            $req->password = '';

            return $req->error = "Somthing wrong";
        }
    }
}
