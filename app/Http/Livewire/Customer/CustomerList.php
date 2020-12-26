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

    /**
     * CustomerList constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->perPage = config('moco.table.perPage');
        $this->perPageOptions = config('moco.table.perPageOptions');
        $this->loadingIndicator =true;
        parent::__construct($id);
    }

    public function query(): Builder
    {
        return Customer::select()->orderBy('name');
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

        ];
    }

}
