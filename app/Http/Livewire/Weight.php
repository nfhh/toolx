<?php

namespace App\Http\Livewire;

use App\Exports\WeightExport;
use App\Models\Product as ProductModel;
use App\Models\Weight as WeightModel;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Weight extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $form = [
        'product_id' => 0,
        'weight' => '',
        'sn' => '',
    ];

    public $guess_val;
    public $diff_val;

    public $products;

    public $search = '';
    public $start_date = '';
    public $end_date = '';
    public $page = 1;

    protected $queryString = [
        'search' => ['except' => ''],
        'start_date' => ['except' => ''],
        'end_date' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->products = ProductModel::all();
        $product = $this->products->first();
        if ($product) {
            $this->form['product_id'] = $product->id;
            $this->guess_val = $product->guess_val;
            $this->diff_val = $product->diff_val;
        }

        $this->fill(request()->only('search', 'page'));
    }

    public function updatedFormProductId($val)
    {
        $product = ProductModel::findOneById($val);
        $this->guess_val = $product->guess_val;
        $this->diff_val = $product->diff_val;
    }

    public function store()
    {
        if (WeightModel::findOneBySn($this->form['sn'])) {
            $this->addError('form.sn', 'SN 重复！');
            return;
        }

        WeightModel::create([
            'product_id' => $this->form['product_id'],
            'sn' => $this->form['sn'],
            'weight' => $this->form['weight'],
            'result' => $this->form['weight'] - $this->guess_val < $this->diff_val, // ok 1
        ]);

        $this->form['weight'] = '';
        $this->form['sn'] = '';
        $this->resetErrorBag();
        session()->flash('message', '添加成功！');
        $this->dispatchBrowserEvent('weight-saved');
    }

    public function export()
    {
        return Excel::download(new WeightExport($this->start_date, $this->end_date, $this->search), 'weight.xlsx');
    }

    public function render()
    {
        return view('livewire.weight', [
            'weights' => $this->handleSearch()->with('product')->latest()->paginate(20),
        ])->extends('layouts.dashboard')->section('body');
    }

    protected function buildWhereAnd()
    {
        $model = WeightModel::query();
        if ($this->start_date && $this->end_date) {
            $model->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59']);
        }
        return $model;
    }

    public function handleSearch()
    {
        $model = $this->buildWhereAnd();

        if ($this->search) {
            $columns = array_diff((new WeightModel)->findAllFields(), ['id', 'created_at', 'updated_at']);
            $conditions = [];
            foreach ($columns as $v) {
                $conditions[] = [
                    $v, 'like', "%$this->search%"
                ];
            }

            return $model->where(function (Builder $query) use ($conditions) {
                foreach ($conditions as $condition) {
                    $collections = $query->orwhere($condition[0], $condition[1], $condition[2]);
                }
                return $collections;
            });
        }

        return $model;
    }
}
