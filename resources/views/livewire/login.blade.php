@extends('layouts.app')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center display-3 my-5">
                Login
            </h1>
        </div>
        <div class="col-md-6 mx-auto">
            @if(Session::has('success'))
            <p class="alert alert-success my-2">{{Session::get('success')}}</p>
            @endif
            @if($error)
            <p class="alert alert-danger my-2">{{$error}}</p>
            @endif
            <form wire:submit.prevent="handleSubmit">
                <div class="form-group">
                    <input type="text" class="form-control my-2" placeholder="Email" wire:model.debounce.500ms="email" />
                    @error('email')
                    <p class="text-danger my-1 px-2">
                        {{$message}}
                    </p>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control my-2" placeholder="Password" wire:model.debounce.500ms="password" />
                </div>
                @error('password')
                <p class="text-danger my-1 px-2">
                    {{$message}}
                </p>
                @enderror
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-dark">Login</button>
                </div>
                <div class="form-group">
                    <a href="{{route('register')}}" class="btn btn-block btn-dark">Not have account - Register now</a>
                </div>
                <a href="{{ route('google.login') }}" class="btn btn-google btn-user btn-block">
                    <i class="fab fa-google fa-fw"></i> Login with Google
                </a>
                <a href="{{ route('facebook.login') }}" class="btn btn-facebook btn-user btn-block">
                    <i class="fab fa-facebook-f fa-fw"></i>
                    Login with Facebook
                </a>
            </form>
        </div>
    </div>
</div>