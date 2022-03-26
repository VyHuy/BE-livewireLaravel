<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserList extends Component
{
    public $selected_id, $view, $add, $edit, $delete;

    public function mount()
    {
        $permission   = str_split(Auth::user()->role);
        $this->view   = $permission[0];
        $this->add    = $permission[1];
        $this->edit   = $permission[2];
        $this->delete = $permission[3];
    }

    public $upRole;
    public function edit($id)
    {
        $record            = User::find($id);
        $this->selected_id = $record->id;
        $this->upRole      = $record->role;
    }

    public function updateUser()
    {
        $record = User::find($this->selected_id);
        $this->validate([
            'upRole' => 'required',
        ]);
        $record->update([
            'role' => $this->upRole,

        ]);
        session()->flash('message', 'Sửa thành công :))');
        // $this->resetInputFields();

    }
    public function remove($userId)
    {
        $record = User::find($userId);
        $record->delete();
        session()->flash('message', 'remove successfully');
    }
    public function render()
    {

        return view('livewire.user-list', ['record' => User::all()])->extends('layouts.app');
    }
}
