<?php

namespace App\Http\Livewire\Crane;

use App\Moco\Common\MocoLivewireSearchSession;
use App\Models\Truckscrane;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CraneList extends TableComponent
{
    use HtmlComponents, MocoLivewireSearchSession;
    protected $rowClass ='';

    /**
     * CraneList constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->perPage = config('moco.table.perPage');
        $this->perPageOptions = config('moco.table.perPageOptions');
        $this->rowClass =  config('moco.table.rowClass');
        $this->loadingIndicator =true;
        $this->sortField = 'serial';
        $this->sortDefaultIcon = '<i class="fas fa-sort-alpha-down"></i>';
        $this->ascSortIcon = '<i class="fas fa-sort-alpha-up"></i>';
        $this->descSortIcon = '<i class="fas fa-sort-alpha-down"></i>';
        $this->loadSearchSessionValue();
        parent::__construct($id);
    }


    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Truckscrane::query()->where('current','=',true);
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(trans('Serial number'), 'serial')
                ->searchable()
                ->sortable(),
            Column::make(trans('Model'), 'crane_model')
                ->searchable()
                ->sortable(),
            Column::make(trans('Numberplate'), 'plate')
                ->searchable()
                ->sortable(),
            Column::make(trans('Actions'),'actions')
                ->format(function (Truckscrane $model){
                   return view('menus.list-submenu',['whatIs' => 'crane', 'crane' => $model]);
                }),
        ];
    }

    /**
     * @param $attribute
     * @return string|null
     */
    public function setTableHeadClass($attribute): ?string
    {
        $extend = ' ';
        if($attribute == 'actions'){
            $extend .=  'moco-size-column-table-400';
        }
        return 'moco-title-table'.$extend;
    }

    /**
     * @param $attribute
     * @param $value
     * @return string|null
     */
    public function setTableDataClass($attribute, $value): ?string
    {
        return $this->rowClass;
    }


}
