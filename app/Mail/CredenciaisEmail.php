<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CredenciaisEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $email;
    public $senha;
    /**
     * Create a new message instance.
     */
    public function __construct($nome, $email, $senha)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }


    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view('emails.credenciais')
                    ->with([
                        'nome' => $this->nome,
                        'email' => $this->email,
                        'senha' => $this->senha,
                    ])
                    ->subject('ConstruAdmin: Credenciais de Acesso '); // Assunto do email
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Credenciais Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.credenciais', // Substitua 'emails.credenciais' pelo nome correto da sua view
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
