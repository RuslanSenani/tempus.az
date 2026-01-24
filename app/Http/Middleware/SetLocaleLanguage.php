<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        // Sessiyada dil varsa onu götür, yoxdursa config-dəki default dili götür
        $locale = Session::get('locale', config('app.locale'));

        // Laravel-in ana dili təyin edən funksiyası
        App::setLocale($locale);

        return $next($request);
    }
}
