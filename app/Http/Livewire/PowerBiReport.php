<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PowerBiReport extends Component
{
    // URL del informe embebido (reemplázalo con tu enlace de Power BI)
    public $reportUrl = 'https://app.powerbi.com/view?r=eyJrIjoiZjUzZThjMTAtYjYwMi00ZjU2LWFhMTMtY2Y0YjUxMmVhMDEyIiwidCI6ImM0YTY2YzM0LTJiYjctNDUxZi04YmUxLWIyYzI2YTQzMDE1OCIsImMiOjR9';

    public function render()
    {
        return view('livewire.power-bi-report');
    }
}