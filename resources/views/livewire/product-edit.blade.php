<div class="card">
    <div class="card-header">
        编辑型号
    </div>
    <div class="card-body">
        <form wire:submit.prevent="update">
            <div class="form-group">
                <label for="name">型号</label>
                <input type="text" class="form-control" id="name" wire:model.defer="form.name" required>
            </div>
            <div class="form-group">
                <label for="guess_val">预设值</label>
                <input type="text" class="form-control" id="guess_val" wire:model.defer="form.guess_val" required>
            </div>
            <div class="form-group">
                <label for="diff_val">误差值</label>
                <input type="text" class="form-control" id="diff_val" wire:model.defer="form.diff_val" required>
            </div>
            <button type="submit" class="btn btn-primary">确定</button>
        </form>
    </div>
</div>

