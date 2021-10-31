@if($this->tableIsFiltered)
    <tr>
        @foreach($columns as $column)
            <td>
                @if($column->isFiltered())
                    {{$column->getFilter()->show()}}
                @endif
            </td>
        @endforeach
    </tr>
@endif
