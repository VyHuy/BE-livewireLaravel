<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $error = '';
    public $email;
    public $password;
    public $role;

    protected $rules = [
        'email'    => 'required|email',
        'password' => 'required',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly(
            $propertyName,
            [
                'email'    => 'required|email',
                'password' => 'required',
            ],
        );
    }
    public function handleSubmit()
    {
        $this->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {

            session()->flash('success', 'login successfully');
            return redirect(route('home'));
        } else {
            $this->email    = '';
            $this->password = '';

            return $this->error = "Somthing wrong";
        }
    }
    public function render()
    {
        return view('livewire.login')->extends('layouts.app');
    }
}
