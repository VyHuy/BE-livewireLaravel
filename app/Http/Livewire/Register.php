<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $confirmPass;
    public $error;
    public $role;
    protected $rules = [
        'name'        => 'required|min:3',
        'email'       => 'required|unique:users|email|max:255|regex:/(.*)@gmail\.com/i',
        'password'    => 'required|min:8|same:confirmPass',
        'confirmPass' => 'required',

    ];
    public function updated($propertyName)
    {
        $this->validateOnly(
            $propertyName,
            [
                'name'        => 'required|min:3',
                'email'       => 'required|unique:users|email|max:255|regex:/(.*)@gmail\.com/i',
                'confirmPass' => 'required',
                'password'    => 'required|min:8|same:confirmPass',
            ],
        );
    }
    public function handleSubmit()
    {
        $this->validate([
            'name'        => 'required|min:3',
            'email'       => 'required|unique:users|email|max:255|regex:/(.*)@gmail\.com/i',
            'password'    => 'required|min:8|same:confirmPass',
            'confirmPass' => 'required',

        ]);
        $hashPass = Hash::make($this->password);
        $user     = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => $hashPass,
            'role'     => 1000,
        ]);

        if ($user) {
            session()->flash('success', 'register successfully');
            // return redirect(route("login"));
            return response()->json([
                'name'     => $this->name,
                'email'    => $this->email,
                'password' => $hashPass,
                'role'     => 1000,
            ]);
        } else {
            return $this->error = "Somthing wrong";
        }
    }
    public function render()
    {
        return view('livewire.register')->extends('layouts.app');
    }
}
