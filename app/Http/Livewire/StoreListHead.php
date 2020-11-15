<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class StoreListHead extends Component
{
    public $year = null;
    public $enabled = null;

    public function mount()
    {
        $this->year = Carbon::now()->year;
        $this->enabled = true;
    }

    public function render()
    {
        if ($this->year >= 2000 and $this->year <= 2100)
        {
            $this->emit('headerChange',$this->year, $this->enabled);
        }
        return view('livewire.store-list-head');
    }
}
