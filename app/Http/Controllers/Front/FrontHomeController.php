<?php

namespace App\Http\Controllers\Front;

use App\Contracts\AboutRepositoryInterface;
use App\Contracts\LanguageRepositoryInterface;
use App\Contracts\SettingsRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontHomeController extends Controller
{
    private string $viewFolder;
    private AboutRepositoryInterface $aboutRepository;
    private LanguageRepositoryInterface $languageRepository;
    private SettingsRepositoryInterface $settingsRepository;

    public function __construct(AboutRepositoryInterface $aboutRepository, LanguageRepositoryInterface $languageRepository, SettingsRepositoryInterface $settingsRepository)
    {
        $this->aboutRepository = $aboutRepository;
        $this->languageRepository = $languageRepository;
        $this->settingsRepository = $settingsRepository;
        $this->viewFolder = 'Front/';
    }

    public function index()
    {
        $abouts = $this->aboutRepository->getAll();
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $viewData = [
            'viewFolder' => $this->viewFolder . "Home_v",
            'abouts' => $abouts,
            'languages' => $languages,
            'setting' => $setting
        ];
        return view("{$viewData['viewFolder']}.index")->with($viewData);

    }
}
