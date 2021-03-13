<div class="card" x-data>
    <div class="card-header d-flex justify-content-between align-items-center">
        型号列表
        <a href="{{ route('product.create') }}" class="btn btn-primary">
            添加
        </a>
    </div>
    <div class="card-body">
        <x-success></x-success>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">序号</th>
                    <th scope="col">型号</th>
                    <th scope="col">产品标准重量（g）</th>
                    <th scope="col">重量误差范围（g）</th>
                    <th scope="col">添加时间</th>
                    <th scope="col">编辑时间</th>
                    <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->guess_val }} 克</td>
                        <td>{{ $product->diff_val }} 克</td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('product.edit',$product->id) }}" class="btn btn-primary">编辑</a>
                                <button x-on:click="confirm(`确定删除吗？`) === false || $wire.destroy({{ $product->id }})" class="btn btn-danger">删除</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

