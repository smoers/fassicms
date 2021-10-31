<select class="form-control form-control-sm">
    @foreach($fields as $field => $name)
        <option value="{{$field}}">{{__($name)}}</option>
    @endforeach
</select>
