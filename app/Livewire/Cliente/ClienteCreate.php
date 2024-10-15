<?php

namespace App\Livewire\Cliente;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class ClienteCreate extends Component
{
    public function render(): View
    {
        return view('livewire.cliente.cliente-create');
    }
}
