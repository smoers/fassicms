<div class="d-flex flex-sm-row">
    <select class="form-control form-control-sm" wire:model="filters.{{$name[0]}}" style="width: 60px">
        <option value="=" selected>=</option>
        <option value=">" >></option>
        <option value="<" ><</option>
        <option value=">=" >>=</option>
        <option value="<=" ><=</option>
        <option value="<>" ><></option>
    </select>
    <input type="number" class="form-control form-control-sm" wire:model.debounce.750ms="filters.{{$name[1]}}" value="{{$defaultValue}}">
</div>
