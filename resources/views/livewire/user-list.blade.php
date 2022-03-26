@extends('layouts.app')

<div class="container">
    <a href="/">Home</a>
    <table class="table table-hover">
        <thead>
            <th>Role</th>
            <th>Name</th>
            <th>Email</th>

        </thead>
        <tbody>
            @foreach($record as $p)

            <tr>
                <td>{{$p->role}}</td>
                <td>{{$p->name}}</td>
                <td>{{$p->email}}</td>
                <td>
                    @if(Auth::check('login') == false )
                    @elseif($view ==1 && $add == 1 && $edit == 1 && $delete==1)
                    <a type="small-button" class="btn btn-success" wire:click="edit({{$p->id}})">Sửa</a>
                    <a type="small-button" class="btn btn-danger" wire:click="remove({{$p->id}})">Delete</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @include('livewire.update-user')
    <div class="row">


    </div>

</div>