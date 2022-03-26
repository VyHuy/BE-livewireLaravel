<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dangKy(){
        return view('auth.add');
    }
    public function post_dang_ky(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ],
        [
            'name.required' => 'Nhập họ tên',
            'email.required' => 'Nhập email',
            'password.required' => 'Nhập password'
        ]);
        User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>bcrypt($req->password),

        ]);
        return redirect()->route('login');
    }
    public function login(){
        return view('auth.login');
    }
    public function post_login(Request $req){
        // dd(Auth::attempt($req->only('email', 'password')));
        if(Auth::attempt($req->only('email', 'password'))){
            return response()->json([
                'error' => false,
                'message' => 'Thanh cong'
            ], 200);
        }
        else{
            return response()->json([
                'error' => true,
                'message' => 'Loi mat roi'
            ], 200);
        }
        dd(Auth::user());
    }
    public function logout(){
        Auth::logout();
        return view('welcome');
    }

    public function index(){
        return view('welcome');
    }
}
