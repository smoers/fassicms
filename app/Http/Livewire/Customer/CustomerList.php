<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CustomerList extends TableComponent
{
    use HtmlComponents;
    protected $rowClass ='';

    /**
     * CustomerList constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->perPage = config('moco.table.perPage');
        $this->perPageOptions = config('moco.table.perPageOptions');
        $this->loadingIndicator =true;
        $this->sortField = 'name';
        $this->sortDefaultIcon = '<i class="fas fa-sort-alpha-down"></i>';
        $this->ascSortIcon = '<i class="fas fa-sort-alpha-up"></i>';
        $this->descSortIcon = '<i class="fas fa-sort-alpha-down"></i>';
        parent::__construct($id);
    }

    public function query(): Builder
    {
        return Customer::select();
    }

    public function columns(): array
    {
        return [
            Column::make(trans('Company name'),'name')
                ->searchable()
                ->sortable(),
            Column::make(trans('City'),'city')
                ->searchable()
                ->sortable(),
            Column::make(trans('Email address'),'mail')
                ->searchable()
                ->sortable(),
            Column::make(trans('Phone'),'phone')
                ->searchable()
                ->sortable(),
            Column::make(trans('Mobile'),'mobile')
                ->searchable()
                ->sortable(),
            Column::make(trans('Actions'),'actions')
                ->format(function (Customer $model){
                    return view('menus.list-submenu',['whatIs' => 'customer', 'customer' => $model]);
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
            $extend .=  'moco-size-table';
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
