<?php

namespace App\Http\Middleware;

use App\Contracts\LanguageRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleLanguage
{
    private LanguageRepositoryInterface $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // 1. Bazadakı cari default dili götür (Repository vasitəsilə)
        $defaultLang = $this->languageRepository->getDefaultLanguage();
        $defaultCode = $defaultLang ? $defaultLang['code'] : config('app.locale');

        // 2. Əgər sessiyada 'last_default' yoxdursa və ya admin tərəfdən dəyişdirilibsə
        if (!session()->has('last_default') || session('last_default') !== $defaultCode) {
            // Admin dili dəyişib! İstifadəçinin köhnə manual seçimini sıfırla ki, yeni default dilə keçsin
            session()->forget('active_languages');
            session()->put('last_default', $defaultCode);
        }

        // 3. İndi seçim edək
        if (session()->has('active_languages')) {
            // İstifadəçi özü dropdown-dan seçib
            $locale = session()->get('locale');
        } else {
            // Heç bir seçim yoxdur, default dili tətbiq et
            $locale = $defaultCode;
        }

        app()->setLocale($locale);
        session()->put('locale', $locale);

        return $next($request);


    }
}
