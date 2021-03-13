<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $test = Test::where('sn', $data['sn'])->first();
        if (is_null($test)) {
            Test::create([
                'sn' => $data['sn'],
                'result' => $data['result'],
                'user_id' => auth('api')->id(),
                'finished' => $data['finished'],
            ]);
        } else {
            $test->uptimes += 1;
            $test->result = $data['result'];
            $test->user_id = auth('api')->id();
            $test->finished = $data['finished'];
            $test->save();
        }
        return response()->json([
            'code' => 0,
            'message' => '保存成功！',
            'data' => null
        ]);
    }
}
