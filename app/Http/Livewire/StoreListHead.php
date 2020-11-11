<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider;

class StoreListHead extends Component
{
    public $year = 2020;
    public function render()
    {
        $this->year = 2200;
        return view('livewire.store-list-head');
    }
}
