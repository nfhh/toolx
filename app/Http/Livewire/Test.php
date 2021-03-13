<?php

namespace App\Http\Livewire;

use App\Exports\TestExport;
use App\Models\Test as TestModel;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Test extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

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
        $this->fill(request()->only('search', 'page'));
    }

    public function export()
    {
        return Excel::download(new TestExport($this->start_date, $this->end_date, $this->search), 'tests.xlsx');
    }

    public function render()
    {
        return view('livewire.test', [
            'tests' => $this->handleSearch()->latest()->paginate(20),
        ])->extends('layouts.dashboard')->section('body');
    }

    protected function buildWhereAnd()
    {
        $model = TestModel::query()->with('user');
        if ($this->start_date && $this->end_date) {
            $model->whereBetween('created_at', [$this->start_date.' 00:00:00', $this->end_date.' 23:59:59']);
        }
        return $model;
    }

    public function handleSearch()
    {
        $model = $this->buildWhereAnd();

        if ($this->search) {
            $columns = array_diff((new TestModel)->findAllFields(), ['id', 'created_at', 'updated_at']);
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
