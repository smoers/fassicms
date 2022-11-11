@var $i = 0
@foreach($models as $model)
    <tr class="{{$this->setTableDataRowClass()}}">
        @foreach($columns as $column)
            <td class="{{$this->setTableDataColumnClass($column)}}">
            @if($column instanceof \App\Moco\Datatables\ColumnEdit)
                {!! $column->setEditMode($this->edit) !!}
                {{$column->getEditField($i,$column,$errors)}}
            @else
                @if($column->isFormatted())
                    {{ $column->formatted($model, $column) }}
                @else
                    {{ data_get($model, $column->getAlias()) }}
                @endif
            @endif
            </td>
        @endforeach
    </tr>
    @var $i++
@endforeach
