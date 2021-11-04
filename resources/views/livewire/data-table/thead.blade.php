<thead class="">
<tr class="{{$this->setTableHeadClass()}}">
    @foreach($columns as $column)
        @if($column->isSortable())
            <th scope="col" class="{{$this->setTableHeadColumnClass($column)}}" wire:click="sort('{{$column->getAttribute()}}')" style="cursor: pointer;">
                {{$column->getName()}}
                @if ($sortField !== $column->getAttribute())
                    {{ new \Illuminate\Support\HtmlString($sortDefaultIcon) }}
                @elseif ($sortDirection === 'asc')
                    {{ new \Illuminate\Support\HtmlString($ascSortIcon) }}
                @else
                    {{ new \Illuminate\Support\HtmlString($descSortIcon) }}
                @endif
                @if($column->isFiltered())
                    <a href="#" class="text-sm-center moco-color-info"><i class="fas fa-filter"></i></a>
                @endif
            </th>
        @else
            <th scope="col" class="{{$this->setTableHeadColumnClass($column)}}">
                {{$column->getName()}}
                @if($column->isFiltered())
                    <a href="#" class="text-sm-center moco-color-info"><i class="fas fa-filter"></i></a>
                @endif
            </th>
        @endif
    @endforeach
</tr>
</thead>
