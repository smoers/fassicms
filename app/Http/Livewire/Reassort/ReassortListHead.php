<?php

namespace App\Http\Livewire\Reassort;

use App\Moco\Common\MocoLivewireSearchSession;
use Livewire\Component;

class ReassortListHead extends Component
{
    use MocoLivewireSearchSession;
    /**
     * propriété utilisée par le trait MocoLivewireSearchSession
     * @var array|string[]
     */
    protected array $properties =  ['locationId'];

    public $locationId = null;

    public function mount()
    {
        $this->locationId = config('moco.reassort.defaultLocation');
        $this->loadSearchSessionValue();
    }
    public function render()
    {
        $this->emit('headerChange',$this->locationId);
        return view('livewire.reassort.reassort-list-head');
    }
}
