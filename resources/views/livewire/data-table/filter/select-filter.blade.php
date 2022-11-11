<select class="form-control form-control-sm moco-filter-border-color" wire:model="filters.{{$name}}" @if($readonly) readonly="readonly" @endif>
    @foreach($options as $option => $text)
        <option value="{{$option}}" @if($option == $selected) selected @endif >{{$text}}</option>
    @endforeach
</select>
