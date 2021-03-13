<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserEdit extends Component
{
    public User $user;

    public $form = [
        'name' => '',
        'password' => '',
    ];

    public function mount()
    {
        $this->form['name'] = $this->user->name;
    }

    public function update()
    {
        $this->user->name = $this->form['name'];
        if ($this->form['password']) {
            $this->user->password = $this->form['password'];
        }
        $this->user->save();
        session()->flash('success', '编辑用户成功！');
        return redirect(route('user.index'));
    }

    public function render()
    {
        return view('livewire.user-edit')
            ->extends('layouts.dashboard')
            ->section('body');
    }
}
