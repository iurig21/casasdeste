<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $nome,
        public string $email,
        public string $contacto,
        public string $mensagem,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "A sua mensagem foi recebida - Casas D'Este",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-confirmation',
            with: [
                'logoPath' => public_path('imagens/logo1.png'),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
