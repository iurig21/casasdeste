<?php

namespace App\Http\Controllers;

use App\Mail\ContactConfirmationMail;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $digitsOnly = preg_replace('/\D/', '', (string) $request->input('contacto', ''));
        $request->merge(['contacto' => $digitsOnly]);

        $validated = $request->validateWithBag('contact', [
            'nome' => 'required|string|max:70',
            'email' => 'required|email|max:255',
            'contacto' => 'required|string|size:9|regex:/^9[0-9]{8}$/',
            'mensagem' => 'required|string|max:500',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'Excedeu o número máximo de caracteres (70) para o campo nome.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Email inválido.',
            'contacto.required' => 'O campo contacto é obrigatório.',
            'contacto.size' => 'O contacto deve ter 9 dígitos',
            'contacto.regex' => 'Formato de contacto inválido (9XX XXX XXX).',
            'mensagem.required' => 'O campo mensagem é obrigatório.',
            'mensagem.max' => 'Excedeu o número máximo de caracteres (500) para o campo mensagem.',
        ]);

        $contactData = [
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'contacto' => $validated['contacto'],
            'mensagem' => $validated['mensagem'],
        ];

        Mail::to('iuri@digitosolutions.com')
            ->send(new ContactMail(...$contactData));

        Mail::to($validated['email'])
            ->send(new ContactConfirmationMail(...$contactData));

        return back()->with('success', 'Mensagem enviada com sucesso!');
    }
}
