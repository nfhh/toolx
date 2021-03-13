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
            <th scope="col">硬盘型号</th>
            <th scope="col">外接U盘</th>
            <th scope="col">网络接口</th>
            <th scope="col">添加时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tests as $test)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $test->user->name }}</td>
                <td>{{ $test->sn }}</td>
                <td>{{ $test->model }}</td>
                <td>{{ $test->kernel_version }}</td>
                <td>{{ $test->bios_version }}</td>
                <td>{{ $test->cpu }}</td>
                <td>{{ $test->cpu_temp }}</td>
                <td>{{ $test->cpu_used }}</td>
                <td>{!! implode('<br/>', $test->mac) !!}</td>
                <td>{{ $test->fan_speed }}</td>
                <td>{{ $test->ram }}</td>
                <td>{{ $test->nas_temp }}</td>
                <td>{!! implode('<br/>', $test->disk) !!}</td>
                <td>
                    @foreach($test->u_disk as $it)
                        {{ $it['devicename'] }} ：{{ $it['size'] }}<br/>
                    @endforeach
                </td>
                <td>
                    @foreach($test->net as $k=>$v)
                        {{ $k }} : {{ $v }} <br/>
                    @endforeach
                </td>
                <td>{!! implode('<br/>', $test->shell_res) !!}</td>
                <td>{{ $test->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
