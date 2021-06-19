<?php

namespace App\Http\Livewire\Provider;

use Livewire\Component;

class ProviderListHead extends Component
{
    public $edit = false;
    public $submit = null;

    public function render()
    {
        return view('livewire.provider.provider-list-head');
    }

    public function edit()
    {
        $this->edit = !$this->edit;
    }
}
