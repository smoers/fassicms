@if($this->tableIsFiltered)
    <tr>
        @foreach($columns as $column)
            <td>
                @if($column->isFiltered())
                    @if($column instanceof \App\Moco\Datatables\ColumnEdit)
                        {{$column->getFilter()->setReadOnly($this->edit)}}
                    @endif
                    {{$column->getFilter()->show()}}
                @endif
            </td>
        @endforeach
    </tr>
@endif
