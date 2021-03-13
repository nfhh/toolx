<div class="card">
    <div class="card-header">
        SN与重量绑定
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
        <x-success></x-success>
        <form class="pb-3" wire:submit.prevent="store" x-data @weight-saved.window="$refs.foo.focus()">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="product_id">型号</label>
                    <select id="product_id" class="form-control" wire:model="form.product_id">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>产品标准重量（g）</label>
                    <input type="text" readonly class="form-control-plaintext" value="{{ $guess_val }}">
                </div>
                <div class="form-group col-md-3">
                    <label>重量误差范围（g）</label>
                    <input type="text" readonly class="form-control-plaintext" value="{{ $diff_val }}">
                </div>
                <div class="form-group col-md-3">
                    <label>实际值（g）</label>
                    <input type="text" class="form-control" wire:model.defer="form.weight">
                </div>
            </div>
            <div class="form-group">
                <label for="sn">SN</label>
                <input type="search" class="form-control @error('form.sn') is-invalid @enderror" id="sn" autofocus required wire:model.defer="form.sn" x-on:input="$event.target.classList.remove('is-invalid')" x-ref="foo">
                @error('form.sn')
                <span class="invalid-feedback">
    <strong>{{ $message }}</strong>
</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">确定</button>
        </form>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">序号</th>
                    <th scope="col">型号</th>
                    <th scope="col">产品标准重量（g）</th>
                    <th scope="col">重量误差范围（g）</th>
                    <th scope="col">实际值（g）</th>
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
        {{ $weights->links() }}
    </div>
</div>
