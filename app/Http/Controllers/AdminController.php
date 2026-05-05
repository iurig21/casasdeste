<?php

namespace App\Http\Controllers;

use App\Models\BrochureDownload;
use Illuminate\Database\Eloquent\Builder;
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
        ], [
            'username.required' => 'O username é obrigatório.',
            'password.required' => 'A password é obrigatória.',
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
        $searchTrimmed = $search !== null ? trim((string) $search) : '';

        $downloads = BrochureDownload::query()
            ->when($searchTrimmed !== '', fn (Builder $query) => $query->adminSearch($searchTrimmed))
            ->orderBy('created_at', 'desc')
            ->paginate(7)
            ->withQueryString();

        $payload = compact('downloads', 'search');

        if ($request->ajax()) {
            return response()->view('admin.partials.dashboard-downloads-inner', $payload);
        }

        return view('admin.dashboard', $payload);
    }

    public function destroy(Request $request, BrochureDownload $download)
    {
        $download->delete();

        $message = 'Registo eliminado com sucesso.';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => $message]);
        }

        $dashboardPath = parse_url(route('admin.dashboard'), PHP_URL_PATH);
        $previousUrl = url()->previous();
        $previousPath = parse_url($previousUrl, PHP_URL_PATH);

        if ($previousPath === $dashboardPath) {
            return redirect()->to($previousUrl)->with('success', $message);
        }

        return redirect()->route('admin.dashboard')->with('success', $message);
    }

    public function logout()
    {
        session()->forget('admin_logged_in');

        return redirect('/admin');
    }
}
