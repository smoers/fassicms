<div class="d-flex flex-row">
    <div class="text-sm-right mr-2">{{__('Per page')}} :</div>
    <div>
        <select class="form-control form-control-sm" wire:model="perPage">
            @foreach($perPageOptions as $perPage)
                <option value="{{$perPage}}">{{$perPage}}</option>
            @endforeach
        </select>
    </div>
</div>
