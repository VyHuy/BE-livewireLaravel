@extends('layouts.app')
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center display-3 my-5">
                    Register
                </h1>
            </div>
            <div class="col-md-6 mx-auto">
                @if($error)
                <p class="alert alert-danger my-2">{{$error}}</p>
                @endif
                <form wire:submit.prevent="handleSubmit">
                    <div class="form-group">
                        <input type="text" class="form-control my-2" placeholder="Name" wire:model.debounce.500ms="name" />
                        @error('name')
                        <p class="text-danger my-1 px-2">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control my-2" placeholder="Email" wire:model.debounce.500ms="email" />
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
                        <input type="password" class="form-control my-2" placeholder="Confirm Password" wire:model.debounce.500ms="confirmPass" />
                        @error('confimPass')
                        <p class="text-danger my-1 px-2">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input value="" class="form-control my-2" wire:model="role" hidden />
                        @error('role')
                        <p class="text-danger my-1 px-2">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-dark">Register</button>
                    </div>
                    <div class="form-group">
                        <a href="{{route('login')}}" class="btn btn-block btn-dark">Have account - Login now</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>