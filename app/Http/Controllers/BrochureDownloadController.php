<?php

namespace App\Http\Controllers;

use App\Models\BrochureDownload;
use Illuminate\Http\Request;

class BrochureDownloadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:brochure_downloads,email',
            'telefone' => 'required|string|size:9|regex:/^9[0-9]{8}$/|unique:brochure_downloads,telefone',
        ], [
            'email.unique' => 'Este email já foi utilizado para download.',
            'telefone.unique' => 'Este telefone já foi utilizado para download.',
        ]);

        BrochureDownload::create([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'telefone' => $validated['telefone'],
        ]);

        return response()->download(public_path('brochura.pdf'), 'brochura.pdf');
    }
}
