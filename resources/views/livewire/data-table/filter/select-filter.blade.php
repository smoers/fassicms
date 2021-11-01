<select class="form-control form-control-sm" wire:model="filters.{{$name}}">
    @foreach($options as $option => $text)
        <option value="{{$option}}" @if($option == $selected) selected @endif >{{$text}}</option>
    @endforeach
</select>
