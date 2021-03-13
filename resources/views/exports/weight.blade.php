<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">序号</th>
            <th scope="col">型号</th>
            <th scope="col">预设值</th>
            <th scope="col">误差值</th>
            <th scope="col">实际值</th>
            <th scope="col">SN</th>
            <th scope="col">结果</th>
            <th scope="col">添加时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($weights as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->product->guess_val }}</td>
                <td>{{ $item->product->diff_val }}</td>
                <td>{{ $item->weight }}</td>
                <td>{{ $item->sn }}</td>
                <td>
                    @if($item->result)
                        <strong class="text-success">OK</strong>
                    @else
                        <strong class="text-danger">NG</strong>
                    @endif
                </td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
