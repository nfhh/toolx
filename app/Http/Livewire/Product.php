<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product as ProductModel;

class Product extends Component
{
    public function destroy($id)
    {
        ProductModel::findOneById($id)->delete();
        session()->flash('success', '删除型号成功！');
    }

    public function render()
    {
        return view('livewire.product', [
            'products' => ProductModel::all()
        ])->extends('layouts.dashboard')->section('body');
    }
}
