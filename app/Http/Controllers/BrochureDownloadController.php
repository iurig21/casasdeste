<?php

namespace App\Http\Controllers;

use App\Mail\BrochureMail;
use App\Models\BrochureDownload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BrochureDownloadController extends Controller
{
    public function store(Request $request)
    {

        $digitsOnly = preg_replace('/\D/', '', (string) $request->input('telefone', ''));
        $request->merge(['telefone' => $digitsOnly]);

        $validated = $request->validateWithBag('brochure', [
            'nome' => 'required|string|max:70',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|size:9|regex:/^9[0-9]{8}$/',
        ]);

        $alreadyExists = BrochureDownload::query()
            ->where('email', $validated['email'])
            ->orWhere('telefone', $validated['telefone'])
            ->exists();

        if (!$alreadyExists) {
            BrochureDownload::create($validated);
        }

        Mail::to($validated['email'])->send(
            new BrochureMail(nome: $validated['nome'])
        );

        return back()->with('brochure_success', 'Enviámos a brochura para o seu email.');
    }
}
