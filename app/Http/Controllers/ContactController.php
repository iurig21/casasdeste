<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contacto' => 'required|string|max:50',
            'mensagem' => 'required|string|max:5000',
        ]);

        Mail::to('iurilameira2017@gmail.com')
            ->send(new ContactMail(
                nome: $validated['nome'],
                email: $validated['email'],
                contacto: $validated['contacto'],
                mensagem: $validated['mensagem'],
            ));

        return back()->with('success', 'Mensagem enviada com sucesso!');
    }
}
