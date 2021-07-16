<div class="card">
    <div class="card-header">
        测试列表
    </div>
    <div class="card-body">
        <form wire:submit.prevent="handleSearch" class="pb-3">
            <div class="form-group">
                <label for="search">关键词</label>
                <input type="text" class="form-control" id="search" wire:model.defer="search">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="start_date">开始日期</label>
                    <input type="date" class="form-control" id="start_date" wire:model.defer="start_date">
                </div>
                <div class="form-group col-md-6">
                    <label for="end_date">结束日期</label>
                    <input type="date" class="form-control" id="end_date" wire:model.defer="end_date">
                </div>
            </div>
            <button class="btn btn-primary" type="submit">搜索</button>
            <button class="btn btn-primary" wire:click="export">导出</button>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">序号</th>
                    <th scope="col">测试人</th>
                    <th scope="col">设备SN</th>
                    <th scope="col">设备型号</th>
                    <th scope="col">内核版本</th>
                    <th scope="col">BIOS版本</th>
                    <th scope="col">CPU型号</th>
                    <th scope="col">CPU温度</th>
                    <th scope="col">CPU使用率</th>
                    <th scope="col">MAC地址</th>
                    <th scope="col">风扇转速</th>
                    <th scope="col">内存容量</th>
                    <th scope="col">设备温度</th>
                    <th scope="col">网络接口</th>
                    <th scope="col">内存测试</th>
                    <th scope="col">USB测试</th>
                    <th scope="col">硬盘型号</th>
                    <th scope="col">结果</th>
                    <th scope="col">测试次数</th>
                    <th scope="col">添加时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tests as $test)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $test->user->name }}</td>
                        <td>{{ $test->sn }}</td>
                        <td>
                            {{ $test->result['model']['res'] }} <span
                                class="{{$test->result['model']['is_ok'] === 'PASS' ? 'text-success' : 'text-danger' }}">{{ $test->result['model']['is_ok'] }}</span>
                        </td>
                        <td>
                            {{ $test->result['kernel_version']['res'] }} <span
                                class="{{$test->result['kernel_version']['is_ok'] === 'PASS' ? 'text-success' : 'text-danger' }}">{{ $test->result['kernel_version']['is_ok'] }}</span>
                        </td>
                        <td>
                            {{ $test->result['bios_version']['res'] }} <span
                                class="{{$test->result['bios_version']['is_ok'] === 'PASS' ? 'text-success' : 'text-danger' }}">{{ $test->result['bios_version']['is_ok'] }}</span>
                        </td>
                        <td>
                            {{ $test->result['cpu']['res'] }} <span
                                class="{{$test->result['cpu']['is_ok'] === 'PASS' ? 'text-success' : 'text-danger' }}">{{ $test->result['cpu']['is_ok'] }}</span>
                        </td>
                        <td>
                            {{ $test->result['cpu_temp']['res'] }} <span
                                class="{{$test->result['cpu_temp']['is_ok'] === 'PASS' ? 'text-success' : 'text-danger' }}">{{ $test->result['cpu_temp']['is_ok'] }}</span>
                        </td>
                        <td>
                            {{ $test->result['cpu_used']['res'] }} <span
                                class="{{$test->result['cpu_used']['is_ok'] === 'PASS' ? 'text-success' : 'text-danger' }}">{{ $test->result['cpu_used']['is_ok'] }}</span>
                        </td>
                        <td>
                            @foreach($test->result['mac'] as $v)
                                {{ $v['res'] }} <span
                                    class="{{$v['is_ok'] === 'PASS' ? 'text-success' : 'text-danger' }}">{{ $v['is_ok'] }}</span>
                                <br/>
                            @endforeach
                        </td>
                        <td>
                            {{ $test->result['fan_speed']['res'] }} <span
                                class="{{$test->result['fan_speed']['is_ok'] === 'PASS' ? 'text-success' : 'text-danger' }}">{{ $test->result['fan_speed']['is_ok'] }}</span>
                        </td>
                        <td>
                            {{ $test->result['ram']['res'] }} <span
                                class="{{$test->result['ram']['is_ok'] === 'PASS' ? 'text-success' : 'text-danger' }}">{{ $test->result['ram']['is_ok'] }}</span>
                        </td>
                        <td>
                            {{ $test->result['nas_temp']['res'] }} <span
                                class="{{$test->result['nas_temp']['is_ok'] === 'PASS' ? 'text-success' : 'text-danger' }}">{{ $test->result['nas_temp']['is_ok'] }}</span>
                        </td>
                        <td>
                            {!! implode('<br/>',$test->result['net']['res']) !!}
                            <span
                                class="{{ \Illuminate\Support\Str::contains($test->result['net']['is_ok'],'PASS') ? 'text-success' : 'text-danger' }}">{{ $test->result['net']['is_ok'] }}</span>
                        </td>
                        <td>
                            {{ str_replace('等待中……',"跳过",$test->result['mem']['res']) }}
                            <span
                                class="{{ \Illuminate\Support\Str::contains($test->result['mem']['is_ok'],'PASS') ? 'text-success' : 'text-danger' }}">{{ str_replace('等待中……',"跳过",$test->result['mem']['is_ok']) }}</span>
                        </td>
                        <td>
                            {!! implode('<br/>',str_replace('等待中……',"跳过",$test->result['u_disk']['res'])) !!}
                            <span
                                class="{{ \Illuminate\Support\Str::contains($test->result['u_disk']['is_ok'],'PASS') ? 'text-success' : 'text-danger' }}">{{ str_replace('等待中……',"跳过",$test->result['u_disk']['is_ok']) }}</span>
                        </td>
                        <td>
                            {!! implode('<br/>',$test->result['disk']['res']) !!}
                            <span
                                class="{{ \Illuminate\Support\Str::contains($test->result['disk']['is_ok'],'PASS') ? 'text-success' : 'text-danger' }}">{!! $test->result['disk']['is_ok'] !!}</span>
                        </td>
                        <td>
                            <strong
                                class="{{$test->finished === 'PASS' ? 'text-success' : 'text-danger' }}">{{ $test->finished }}</strong>
                        </td>
                        <td>{{ $test->uptimes }}</td>
                        <td>{{ $test->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $tests->links() }}
    </div>
</div>

