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
/*        $indicate_year = 'ABCDEFGHKLMN'[now()->year - 2021];
        $millisecond = now()->toDateTimeLocalString('millisecond');
        $millisecond_last = substr($millisecond, -3);
        $sn = $indicate_year.$millisecond_last.Str::random(5);*/
        $mills_timestamp = now()->timestamp . now()->milli; // 13位毫秒时间戳
        $millisecond = now()->toDateTimeLocalString('millisecond');
        $indicate_year = 'ABCDEFGHKLMN'[now()->year - 2020];
        $month_day = now()->month . now()->day;
        $mills_timestamp_last = substr($mills_timestamp, -5);
        $millisecond_last = substr($millisecond, -3);
        $random = Str::random(6);
        return strtoupper($indicate_year . $month_day . $mills_timestamp_last . $millisecond_last . $random);
    }

    public function render()
    {
        return view('livewire.sn')
            ->extends('layouts.dashboard')
            ->section('body');
    }
}
