<div class="card">
    <div class="card-header">
        生成SN
    </div>
    <div class="card-body">
        <form wire:submit.prevent="genSns">
            <div class="form-group">
                <label for="total">个数</label>
                <input type="text" class="form-control" id="total" wire:model.defer="total" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">生成</button>
            </div>
        </form>
        <div class="form-group">
            <label for="sn">SN</label>
            <textarea class="form-control" id="sn" rows="20" wire:model="sns" readonly></textarea>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-secondary" wire:click="export" @if($disabled) disabled @endif>导出
            </button>
        </div>
    </div>
</div>
