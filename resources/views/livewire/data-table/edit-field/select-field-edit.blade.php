<select class="{{$class}} @if (array_key_exists('wireData.'.$index.'.'.$alias,$errors->getMessages())) is-invalid @endif"  data-toggle="tooltip" data-html="true" data-placement="top" title="{{\App\Moco\Datatables\SpreadsheetDataTableComponent::getErrorMessageHTML($index,$alias,$errors)}}" wire:model.lazy="wireData.{{$index}}.{{$alias}}">
    @foreach($options as $option => $text)
        <option value="{{$option}}" @if(intval($option) == intval($this->wireData[$index][$alias])) selected @endif>{{$text}}</option>
    @endforeach
</select>
