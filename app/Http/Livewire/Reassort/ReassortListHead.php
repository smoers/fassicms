<?php

namespace App\Http\Livewire\Reassort;

use Livewire\Component;

class ReassortListHead extends Component
{

    public $locationId = null;

    public function mount()
    {
        $this->locationId = config('moco.reassort.defaultLocation');
    }
    public function render()
    {
        $this->emit('headerChange',$this->locationId);
        return view('livewire.reassort.reassort-list-head');
    }
}
