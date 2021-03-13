<?php

namespace App\Http\Livewire;

use App\Models\User as UserModel;
use Livewire\Component;

class UserCreate extends Component
{
    public $form = [
        'name' => '',
        'password' => '',
    ];

    public function store()
    {
        UserModel::create($this->form);
        session()->flash('success', '添加用户成功！');
        return redirect(route('user.index'));
    }

    public function render()
    {
        return view('livewire.user-create')->extends('layouts.dashboard')->section('body');
    }
}
