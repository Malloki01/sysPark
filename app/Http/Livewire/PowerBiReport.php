<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PowerBiReport extends Component
{
    // URL del informe embebido (reemplázalo con tu enlace de Power BI)
    public $reportUrl = 'https://app.powerbi.com/reportEmbed?reportId=e1e743ff-4193-4893-973e-b24509f4803b&autoAuth=true&ctid=c4a66c34-2bb7-451f-8be1-b2c26a430158';

    public function render()
    {
        return view('livewire.power-bi-report');
    }
}