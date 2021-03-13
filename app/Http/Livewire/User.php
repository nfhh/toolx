<?php

namespace App\Http\Livewire;

use App\Models\User as UserModel;
use Livewire\Component;

class User extends Component
{
    public function destroy($id)
    {
        UserModel::findOneById($id)->delete();
        session()->flash('success', '删除用户成功！');
    }

    public function render()
    {
        return view('livewire.user', [
            'users' => UserModel::all()
        ])->extends('layouts.dashboard')->section('body');
    }
}
