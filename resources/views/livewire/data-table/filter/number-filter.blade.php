<div class="d-flex flex-sm-row">
    <select class="form-control form-control-sm moco-filter-border-color" wire:model="filters.{{$name[0]}}" style="width: 60px" @if($readonly) readonly="readonly" @endif>
        <option value="=" selected>=</option>
        <option value=">" >></option>
        <option value="<" ><</option>
        <option value=">=" >>=</option>
        <option value="<=" ><=</option>
        <option value="<>" ><></option>
    </select>
    <input type="number" class="form-control form-control-sm moco-filter-border-color" wire:model.debounce.750ms="filters.{{$name[1]}}" value="{{$defaultValue}}" @if($readonly) readonly="readonly" @endif>
</div>
