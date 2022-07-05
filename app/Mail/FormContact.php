<?php

namespace App\Mail;

use App\Models\Contactos;
use App\Models\Empresa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormContact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $contacto; 
    public $empresa;

    public function __construct(Contactos $contacto,Empresa $empresa)
    {
        $this->contacto = $contacto;
        $this->empresa = $empresa;
     
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       /*  return $this->view('layouts.email'); */
       return $this
       ->subject('Formulario de contacto - '.config('app.name'))
       ->markdown('emails.contact');
    }
}
