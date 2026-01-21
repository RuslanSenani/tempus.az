<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NovaLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Yalnız Nova route-ları üçün yoxla
        if ($request->is('nova/*') && session()->has('nova_locale')) {
            app()->setLocale(session('nova_locale')); // seçilmiş dili aktiv et
        }

        return $next($request);
    }
}
