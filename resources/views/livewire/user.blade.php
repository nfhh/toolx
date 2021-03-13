<div class="card" x-data>
    <div class="card-header d-flex justify-content-between align-items-center">
        用户列表
        <a href="{{ route('user.create') }}" class="btn btn-primary">
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
                    <th scope="col">名字</th>
                    <th scope="col">添加时间</th>
                    <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('user.edit',$user->id) }}" class="btn btn-primary">编辑</a>
                                @if($user->role === 0)
                                    <button x-on:click="confirm(`确定删除吗？`) === false || $wire.destroy({{ $user->id }})"
                                            class="btn btn-danger">删除
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
