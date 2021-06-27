    <div class="d-flex justify-content-start">
        <button class="btn btn-danger moco-btn-sm" wire:click="edit({{$model->id}})">{{__('Edit')}}</button>
        <button class="btn btn-primary moco-btn-sm" wire:click="save({{$model->id}})" @if(!$edit) disabled @endif  >{{__('Save')}}</button>
    </div>
