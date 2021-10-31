<thead class="">
<tr class="{{$this->setTableHeadClass()}}">
    @foreach($columns as $column)
        <th scope="col" class="{{$this->setTableHeadColumnClass($column)}}">{{$column->getName()}}</th>
    @endforeach
</tr>
</thead>
