<?php

namespace App\Services;

use App\Mail\BrochureMail;
use App\Mail\ContactConfirmationMail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendBrochureMail(string $email, string $nome){
        Mail::to($email)->send(
            new BrochureMail(nome: $nome)
         );
    }

    public function sendContactConfirmationEmail(string $email, string $nome, string $telefone, string $mensagem){
        Mail::to($email)->send(
            new ContactConfirmationMail(nome: $nome,email: $email, telefone: $telefone, mensagem: $mensagem)
        );
    }

    public function sendContactMail(string $email, string $nome, string $telefone, string $mensagem){
        Mail::to("iuri@digitosolutions.com")->send(
            new ContactMail(nome: $nome,email: $email, telefone: $telefone, mensagem: $mensagem)
        );
    }
}
