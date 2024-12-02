<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionIncidencia extends Mailable
{
    use Queueable, SerializesModels;

    public $nombres;

    /**
     * Crear una nueva instancia de mensaje.
     *
     * @param string $nombres
     */
    public function __construct()
    {
        
    }

    /**
     * Construir el mensaje.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.NotificacionIncidencia')
                    ->subject('Incidencia');
    }
}
