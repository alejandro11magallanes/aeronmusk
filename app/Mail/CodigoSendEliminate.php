<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CodigoSendEliminate extends Mailable
{

    public $codigo;

    public function __construct($num)
    {
        $this->codigo = $num;
    }

    public function build()
    {
         return $this->view('codigodelete')
            ->with(['codigo' => $this->codigo]);
    }
}
