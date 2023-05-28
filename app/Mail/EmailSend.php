<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailSend extends Mailable
{
    use Queueable, SerializesModels;

  
    public $correo;

    /**
     * Create a new message instance.
     *
  
     * @param  string  $correo
     * @return void
     */
    public function __construct( $correo)
    {
    
        $this->correo = $correo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('firmada')
                    ->with([
                        'correo' => $this->correo,
                    ])
                    ->to($this->correo);
    }
}
