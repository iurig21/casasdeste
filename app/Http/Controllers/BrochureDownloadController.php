<?php

namespace App\Http\Controllers;

use App\Models\BrochureDownload;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class BrochureDownloadController extends Controller
{
    public function store(Request $request, EmailService $emailService)
    {
    // 1. Limpeza/Sanitização fora da transação
    $digitsOnly = preg_replace('/\D/', '', (string) $request->input('telefone', ''));
    $request->merge(['telefone' => $digitsOnly]);

    $validated = $request->validateWithBag('brochure', [
        'nome' => 'required|string|max:70',
        'email' => 'required|email|max:255',
        'telefone' => 'required|string|size:9|regex:/^9[0-9]{8}$/',
    ]);

    DB::beginTransaction();

    try {
        $alreadyExists = BrochureDownload::checkIfDownloadExists(
            email: $validated["email"], 
            telefone: $validated['telefone']
        );

        if (!$alreadyExists) {
            BrochureDownload::create($validated);
        }

        // 2. Tenta enviar o email ANTES do commit
        $emailService->sendBrochureMail(email: $validated['email'], nome: $validated['nome']);

        // 3. Se tudo correu bem, confirma as alterações na BD
        DB::commit();

        return back()->with('brochure_success', 'Enviámos a brochura para o seu email.');

    } catch (Throwable $e) {
        // 4. Se o email falhar (ou qualquer erro acima), reverte a BD
        DB::rollBack();
        
        Log::error("Erro no processo de brochura: " . $e->getMessage());
            
        return back()
            ->withInput() 
            ->withErrors(['error' => "Não foi possível enviar a brochura. Tente novamente mais tarde."]);
    }       
    }

}
