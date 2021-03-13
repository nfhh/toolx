<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductEdit extends Component
{
    public Product $product;

    public $form = [
        'name' => '',
        'guess_val' => '',
        'diff_val' => '',
    ];

    public function mount()
    {
        $this->form['name'] = $this->product->name;
        $this->form['guess_val'] = $this->product->guess_val;
        $this->form['diff_val'] = $this->product->diff_val;
    }

    public function update()
    {
        $this->product->update($this->form);
        session()->flash('success', '编辑型号成功！');
        return redirect(route('product.index'));
    }

    public function render()
    {
        return view('livewire.product-edit')
            ->extends('layouts.dashboard')
            ->section('body');
    }
}
