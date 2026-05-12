<?php

namespace App\Http\Controllers;

use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ContactController extends Controller
{
    public function send(Request $request, EmailService $emailService)
    {

            $digitsOnly = preg_replace('/\D/', '', (string) $request->input('telefone', ''));
            $request->merge(['telefone' => $digitsOnly]);
    
            $validated = $request->validateWithBag('contact', [
                'nome' => 'required|string|max:70',
                'email' => 'required|email|max:255',
                'telefone' => 'required|string|size:9|regex:/^9[0-9]{8}$/',
                'mensagem' => 'required|string|max:500',
            ], [
                'nome.required' => 'O campo nome é obrigatório.',
                'nome.max' => 'Excedeu o número máximo de caracteres (70) para o campo nome.',
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'Email inválido.',
                'telefone.required' => 'O campo telefone é obrigatório.',
                'telefone.size' => 'O telefone deve ter 9 dígitos.',
                'telefone.regex' => 'Formato de telefone inválido (9XX XXX XXX).',
                'mensagem.required' => 'O campo mensagem é obrigatório.',
                'mensagem.max' => 'Excedeu o número máximo de caracteres (500) para o campo mensagem.',
            ]);

            try {
                $emailService->sendContactMail(...$validated);
                $emailService->sendContactConfirmationEmail(...$validated);
        
                return back()->with('success', 'Mensagem enviada com sucesso!');
                
            } catch (Throwable $e) {
                Log::error("Erro no envio de email: " . $e->getMessage());
                
                return back()
                    ->withInput() 
                    ->withErrors(['error' => "Não foi possível enviar a mensagem. Tente novamente mais tarde."],'contact');
            }

    }
}
