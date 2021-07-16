<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;

class Sn extends Component
{
    public $total;

    public $sns;
    public $excel_sns = [];

    public $disabled = true;

    public function genSns()
    {
        for ($i = 0; $i < $this->total; $i++) {
            $str = $this->alg();
            $this->sns .= $str.PHP_EOL;
            $this->excel_sns[] = [$str];
        }
        $this->disabled = false;
    }

    public function export()
    {
        return (collect($this->excel_sns))->downloadExcel('SN.xlsx');
    }

    private function alg()
    {
        $indicate_year = 'ABCDEFGHKLMN'[now()->year - 2021];
        $millisecond = now()->toDateTimeLocalString('millisecond');
        $millisecond_last = substr($millisecond, -3);
        $sn = $indicate_year.$millisecond_last.Str::random(5);
        return strtoupper($sn);
    }

    public function render()
    {
        return view('livewire.sn')
            ->extends('layouts.dashboard')
            ->section('body');
    }
}
