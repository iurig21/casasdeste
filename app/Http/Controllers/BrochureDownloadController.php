<?php

namespace App\Http\Controllers;

use App\Models\BrochureDownload;
use Illuminate\Http\Request;

class BrochureDownloadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validateWithBag('brochure', [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|size:9|regex:/^9[0-9]{8}$/',
        ]);

        $alreadyExists = BrochureDownload::query()
            ->where('email', $validated['email'])
            ->orWhere('telefone', $validated['telefone'])
            ->exists();

        if (!$alreadyExists) {
            BrochureDownload::create([
                'nome' => $validated['nome'],
                'email' => $validated['email'],
                'telefone' => $validated['telefone'],
            ]);
        }

        return response()->download(public_path('brochura.pdf'), 'brochura.pdf');
    }
}
