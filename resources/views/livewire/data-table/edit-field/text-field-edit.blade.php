<input
    class="{{$class}} @if (array_key_exists('wireData.'.$index.'.'.$alias,$errors->getMessages())) is-invalid @endif"
    data-toggle="tooltip"
    data-html="true"
    data-placement="top"
    title="{{\App\Moco\Datatables\SpreadsheetDataTableComponent::getErrorMessageHTML($index,$alias,$errors)}}"
    type="text"
    wire:model.lazy="wireData.{{$index}}.{{$alias}}"
/>


