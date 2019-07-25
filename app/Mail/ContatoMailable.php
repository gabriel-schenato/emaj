<?php

namespace Emaj\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContatoMailable extends Mailable implements ShouldQueue
{

    use Queueable,
        SerializesModels;

    public $dados;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contato')
                ->subject('Nova mensagem do portal do EMAJ')
                ->from($this->dados['email'], $this->dados['nome'])
                ->to('emaj@uniplaclages.edu.br', config('app.name'));
    }

}