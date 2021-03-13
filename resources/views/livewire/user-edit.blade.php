<div class="card">
    <div class="card-header">
        编辑用户
    </div>
    <div class="card-body">
        <form wire:submit.prevent="update">
            <div class="form-group">
                <label for="name">用户名</label>
                <input type="text" class="form-control" id="name" wire:model.defer="form.name" required>
            </div>
            <div class="form-group">
                <label for="password">密码</label>
                <input type="password" class="form-control" id="password" wire:model.defer="form.password">
            </div>
            <button type="submit" class="btn btn-primary">确定</button>
        </form>
    </div>
</div>

