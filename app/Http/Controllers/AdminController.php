<?php

namespace App\Http\Controllers;

use App\Models\BrochureDownload;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loginForm()
    {
        if (session('admin_logged_in')) {
            return redirect('/admin/dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        if ($request->username === config('admin.username') && $request->password === config('admin.password')) {
            session(['admin_logged_in' => true]);
            return redirect('/admin/dashboard');
        }

        return back()->withErrors(['username' => 'Credenciais inválidas.']);
    }

    public function dashboard(Request $request)
    {
        $search = $request->input('search');

        $downloads = BrochureDownload::query()
            ->when($search, function ($query, $search) {
                $query->where('nome', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('telefone', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(7)
            ->withQueryString();

        return view('admin.dashboard', compact('downloads', 'search'));
    }

    public function destroy(BrochureDownload $download)
    {
        $download->delete();

        return redirect('/admin/dashboard')->with('success', 'Registo eliminado com sucesso.');
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect('/admin');
    }
}
