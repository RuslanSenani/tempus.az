<?php

namespace App\Http\Controllers;

use App\Contracts\LanguageRepositoryInterface;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    private LanguageRepositoryInterface $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function switch($lang): RedirectResponse
    {
        $activeLanguages = $this->languageRepository->getAllLanguages();


        if ($activeLanguages->contains('code', $lang)) {
            session(['locale' => $lang]);
        }

        return redirect()->back();
    }
}
