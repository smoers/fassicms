<thead class="">
<tr class="{{$this->setTableHeadClass()}}">
    @foreach($columns as $column)
        @if($column->isSortable())
            <th scope="col" class="{{$this->setTableHeadColumnClass($column)}}" data-rtc-resizable="{{$column->getRandomKey()}}">
                {{$column->getName()}}
                @if(!$this->edit)
                    <a href="#" class="text-sm-center moco-color-info" wire:click="sort('{{$column->getAttribute()}}')">
                        @if ($sortField !== $column->getAttribute())
                            {{ new \Illuminate\Support\HtmlString($sortDefaultIcon) }}
                        @elseif ($sortDirection === 'asc')
                            {{ new \Illuminate\Support\HtmlString($ascSortIcon) }}
                        @else
                            {{ new \Illuminate\Support\HtmlString($descSortIcon) }}
                        @endif
                    </a>
                    @if($column->isFiltered())
                        <a href="#" class="text-sm-center moco-color-info" wire:click="cleanColumnFilter('{{$column->getAlias()}}')"><i class="fas fa-filter"></i></a>
                    @endif
                @endif
            </th>
        @else
            <th scope="col" class="{{$this->setTableHeadColumnClass($column)}}" data-rtc-resizable="{{$column->getRandomKey()}}">
                {{$column->getName()}}
                @if(!$this->edit)
                    @if($column->isFiltered())
                        <a href="#" class="text-sm-center moco-color-info" wire:click="cleanColumnFilter('{{$column->getAlias()}}')"><i class="fas fa-filter"></i></a>
                    @endif
                @endif
            </th>
        @endif
    @endforeach
</tr>
</thead>
