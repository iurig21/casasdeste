<?php

namespace App\Console\Commands;

use App\Mail\ContactConfirmationMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendCustomerEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     *
     * @var string
     */
    protected $signature = 'mail:send-customer {nome=Teste} {email=iuri@digitosolutions.com} {telefone=933968821} {mensagem=Mensagem de teste}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test customer confirmation email (same mailable as the contact form)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $nome = (string) $this->argument('nome');
        $email = (string) $this->argument('email');
        $telefone = (string) $this->argument('telefone');
        $mensagem = (string) $this->argument('mensagem');

        $contactData = compact('nome', 'email', 'telefone','mensagem');

        Mail::to($email)->send(new ContactConfirmationMail(...$contactData));

        $this->info('Email successfully sent!');

        return self::SUCCESS;
    }
}
