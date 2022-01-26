<?php

namespace App\Http\Livewire\Technician;

use App\Moco\Common\MocoLivewireSearchSession;
use App\Models\Technician;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class TechnicianList extends TableComponent
{
    use HtmlComponents, MocoLivewireSearchSession;
    protected $rowClass ='';

    /**
     * TechnicianList constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->perPage = config('moco.table.perPage');
        $this->perPageOptions = config('moco.table.perPageOptions');
        $this->rowClass =  config('moco.table.rowClass');
        $this->loadingIndicator =true;
        $this->sortField = 'lastname';
        $this->sortDefaultIcon = '<i class="fas fa-sort-alpha-down"></i>';
        $this->ascSortIcon = '<i class="fas fa-sort-alpha-up"></i>';
        $this->descSortIcon = '<i class="fas fa-sort-alpha-down"></i>';
        $this->loadSearchSessionValue();
        parent::__construct($id);
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(trans('Number'), 'number')
                ->searchable()
                ->sortable(),
            Column::make(trans('Lastname'),'lastname')
                ->searchable()
                ->sortable(),
            Column::make(trans('Firstname'),'firstname')
                ->searchable()
                ->sortable(),
            Column::make(trans('Enabled'), 'enabled')
                ->searchable()
                ->sortable()
                ->format(function (Technician $model){
                    return $model->enabled == 1 ? trans('Yes') : trans('No');
                }),
            Column::make(trans('Actions'),'actions')
                ->format(function (Technician $model){
                    return view('menus.list-submenu',['whatIs' => 'technician', 'technician' => $model]);
                }),
        ];
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Technician::select();
    }


    /**
     * @param $attribute
     * @return string|null
     */
    public function setTableHeadClass($attribute): ?string
    {
        $extend = ' ';
        switch ($attribute) {
            case 'actions':
                $extend .=  'moco-size-column-table-400';
                break;
            case 'enabled':
            case 'number':
                $extend .= 'moco-size-column-table-150';
                break;
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
