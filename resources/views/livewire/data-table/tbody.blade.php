@foreach($models as $model)
    <tr class="{{$this->setTableDataClass()}}">
        @foreach($columns as $column)
            <td class="{{$this->setTableDataColumnClass($column)}}">
                @if($column->isFormatted())
                    {{ $column->formatted($model, $column) }}
                @else
                    {{ data_get($model, $column->getAlias()) }}
                @endif
            </td>
        @endforeach
    </tr>
@endforeach
