<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BrochureMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $nome,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "A sua brochura - Casas D'Este",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.brochure',
            with: [
                'logoPath' => public_path('imagens/logo1.png'),
            ],
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromPath(public_path('brochura.pdf'))
                ->as('brochura-casas-deste.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
