<?php

namespace App\Http\Livewire\ReassortLevel;

use App\Models\ViewPartmetadatasReassort;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ReassortLevelList extends TableComponent
{
    use HtmlComponents;

    /**
     * ReassortListParts constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->perPage = config('moco.table.perPage');
        $this->paginationTheme = 'bootstrap';
        $this->perPageOptions = config('moco.table.perPageOptions');
        $this->rowClass =  config('moco.table.rowClass');
        $this->loadingIndicator =true;
        $this->sortField = 'part_number';
        $this->sortDefaultIcon = '<i class="fas fa-sort-alpha-down"></i>';
        $this->ascSortIcon = '<i class="fas fa-sort-alpha-up"></i>';
        $this->descSortIcon = '<i class="fas fa-sort-alpha-down"></i>';
        $this->searchEnabled = false;
        parent::__construct($id);
    }

    public function query(): Builder
    {
        return ViewPartmetadatasReassort::select();
    }

    public function columns(): array
    {
        return [
            Column::make(trans('Part Number'), 'part_number')
                ->searchable()
                ->sortable(),
            Column::make(trans('Description'),'description')
                ->searchable()
                ->sortable(),
            Column::make(trans('Quantity'), 'qty')
                ->format(function (ViewPartmetadatasReassort $model){
                    return $this->html('<div class="text-right w-100 ">'.$model->qty.'</div>');
                }),
            Column::make(trans('Reassort Level'),'reassort_level')
                ->format(function (ViewPartmetadatasReassort $model){
                    return $this->html('<div class="text-right w-100 ">'.$model->reassort_level.'</div>');
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
        switch ($attribute) {
            case 'part_number':
                $extend .= 'moco-size-column-table-150';
                break;
            case 'reassort_level':
            case 'qty':
                $extend .= 'moco-size-column-table-100';
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
