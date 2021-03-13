<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product as ProductModel;

class ProductCreate extends Component
{
    public $form = [
        'name' => '',
        'guess_val' => '',
        'diff_val' => '',
    ];

    public function store()
    {
        ProductModel::create($this->form);
        session()->flash('success', '添加型号成功！');
        return redirect(route('product.index'));
    }

    public function render()
    {
        return view('livewire.product-create')
            ->extends('layouts.dashboard')
            ->section('body');
    }
}
