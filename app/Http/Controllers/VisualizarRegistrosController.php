<?php

namespace App\Http\Controllers;

use Livewire\Component;
use App\Registro;
use Illuminate\Http\Request;

class VisualizarRegistrosController extends Component
{

    // Mostrar en XML los registros por DNI
    public function show(Request $request)
    {
        $dni = $request->input('dni');
        $registros = Registro::where('dni', $dni)->get();
        return response()->json($registros);
    }
}
