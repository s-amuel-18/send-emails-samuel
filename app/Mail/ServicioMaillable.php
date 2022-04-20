<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServicioMaillable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Informacion De Contacto";
    public $info ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->info = $data;
        $this->subject = isset($data["subject"]) ? $data["subject"] : $this->subject ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.servicio');
    }
}
