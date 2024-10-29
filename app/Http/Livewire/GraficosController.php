<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Registro; // Ensure this model exists in the specified namespace
use Illuminate\Support\Facades\Log;

class GraficosController extends Component
{
    public function render()
    {
        return view('livewire.graficos.component');
    }

    
}
