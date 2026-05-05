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
        $validated = $request->validateWithBag('contact', [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contacto' => 'required|string|size:9|regex:/^9[0-9]{8}$/',
            'mensagem' => 'required|string|max:500',
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
