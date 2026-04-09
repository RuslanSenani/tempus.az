<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleLanguage
{

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('admin*') || $request->is('nova-api*')) {
            return $next($request);
        }

        $locale = $request->segment(1);
        $activeLanguages = cache('active_languages');
        $allowedLocales = $activeLanguages ? $activeLanguages->pluck('code')->toArray() : ['az'];

        if (in_array($locale, $allowedLocales)) {
            app()->setLocale($locale);
            session()->put('locale', $locale);

            // URL-lərin düzgün yaranması üçün vacibdir
            URL::defaults(['locale' => $locale]);

            return $next($request);
        }

        // Əgər URL-də dil yoxdursa (məsələn, birbaşa tempus.az yazılıbsa)
        $targetLocale = session('locale', config('app.locale'));
        return redirect()->to('/' . $targetLocale . '/' . $request->path());
    }
}
