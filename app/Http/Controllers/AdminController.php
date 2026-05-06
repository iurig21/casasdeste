<?php

namespace App\Http\Controllers;

use App\Models\BrochureDownload;
use Carbon\Carbon;
use Carbon\CarbonInterface;
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

        $dateFromRaw = trim((string) $request->input('date_from', ''));
        $dateToRaw = trim((string) $request->input('date_to', ''));

        $tz = 'Europe/Lisbon';

        $dateFromStart = self::parseAdminDayStartUtc($dateFromRaw, $tz);
        $dateToEnd = self::parseAdminDayEndUtc($dateToRaw, $tz);

        $downloads = BrochureDownload::query()
            ->when($searchTrimmed !== '', fn (Builder $query) => $query->adminSearch($searchTrimmed))
            ->when($dateFromStart instanceof CarbonInterface, fn (Builder $query) => $query->where('created_at', '>=', $dateFromStart))
            ->when($dateToEnd instanceof CarbonInterface, fn (Builder $query) => $query->where('created_at', '<=', $dateToEnd))
            ->orderBy('created_at', 'desc')
            ->paginate(7)
            ->withQueryString();

        $dateFrom = $dateFromStart ? $dateFromRaw : '';
        $dateTo = $dateToEnd ? $dateToRaw : '';

        $payload = compact('downloads', 'search', 'dateFrom', 'dateTo');

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

    private static function parseAdminDayStartUtc(string $ymd, string $tz): ?CarbonInterface
    {
        if ($ymd === '' || ! preg_match('/^\d{4}-\d{2}-\d{2}$/', $ymd)) {
            return null;
        }

        try {
            return Carbon::createFromFormat('Y-m-d', $ymd, $tz)->startOfDay()->utc();
        } catch (\Throwable) {
            return null;
        }
    }

    private static function parseAdminDayEndUtc(string $ymd, string $tz): ?CarbonInterface
    {
        if ($ymd === '' || ! preg_match('/^\d{4}-\d{2}-\d{2}$/', $ymd)) {
            return null;
        }

        try {
            return Carbon::createFromFormat('Y-m-d', $ymd, $tz)->endOfDay()->utc();
        } catch (\Throwable) {
            return null;
        }
    }
}
