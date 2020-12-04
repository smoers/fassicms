<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;

class CustomerList extends TableComponent
{
    use HtmlComponents;
    public $perPage = 15;
    public $perPageOptions = [10,15,20,25,30,35,40,45,50];
    public $loadingIndicator = true;

    public function query(): Builder
    {
        return Customer::all()->sortBy('name');
    }

    public function columns(): array
    {
        return [

        ];
    }

}
