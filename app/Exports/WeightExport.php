<?php

namespace App\Exports;

use App\Models\Weight as WeightModel;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromView;

class WeightExport implements FromView
{

    private $start_date;
    private $end_date;
    private $search;

    public function __construct($start_date, $end_date, $search)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->search = $search;
    }

    public function view(): View
    {
        return view('exports.weight', [
            'weights' => $this->handleSearch()->with('product')->latest()->get(),
        ]);
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
