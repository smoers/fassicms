<?php

namespace App\Http\Livewire\Crane;

use App\Models\Crane;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CraneList extends TableComponent
{
    use HtmlComponents;

    public function __construct($id = null)
    {
        $this->perPage = config('moco.table.perPage');
        $this->perPageOptions = config('moco.table.perPageOptions');
        $this->loadingIndicator =true;
        parent::__construct($id);
    }

    public function query(): Builder
    {
        return Crane::select()->orderBy('serial');
    }

    public function columns(): array
    {
        return [
            Column::make(trans('Serial number'), 'serial')
                ->searchable()
                ->sortable(),
            Column::make(trans('Model'), 'model')
                ->searchable()
                ->sortable(),
            Column::make(trans('Numberplate'), 'plate')
                ->searchable()
                ->sortable(),
            Column::make(trans('Actions'),'actions')
                ->format(function (Crane $model){
                   return view('menus.list-submenu',['whatIs' => 'crane', 'crane' => $model]);
                }),
        ];
    }

    public function setTableHeadClass($attribute): ?string
    {
        $extend = ' ';
        if($attribute == 'actions'){
            $extend .=  'text-right moco-size-table';
        }
        return 'moco-title-table'.$extend;
    }


}
