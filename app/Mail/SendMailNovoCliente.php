<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailNovoCliente extends Mailable
{
  use Queueable, SerializesModels;

  public function __construct()
  {
    //
  }

  public function build()
  {
    return $this->from('alansousa.cc@gmail.com')
                ->subject('Novo Formulário de Cliente Registrado ACPTI')
                ->view('emails.novoCliente');
  }
}
