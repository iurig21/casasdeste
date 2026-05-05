<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(3)
                ->by($request->ip().'|'.$request->path())
                ->response(function (Request $request, array $headers) {
                    if ($request->expectsJson()) {
                        return response()->json([
                            'message' => 'Limite de taxa excedido. Por favor, tente novamente mais tarde.',
                        ], 429, $headers);
                    }

                    return response()
                        ->view('errors.429', [], 429)
                        ->withHeaders($headers);
                });
        });
    }
}
