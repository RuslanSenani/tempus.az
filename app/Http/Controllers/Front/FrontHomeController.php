<?php

namespace App\Http\Controllers\Front;

use App\Contracts\AboutRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\LanguageRepositoryInterface;
use App\Contracts\PreparationRepositoryInterface;
use App\Contracts\SettingsRepositoryInterface;
use App\Contracts\SiteContentInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontHomeController extends Controller
{
    private string $viewFolder;
    private AboutRepositoryInterface $aboutRepository;
    private LanguageRepositoryInterface $languageRepository;
    private SettingsRepositoryInterface $settingsRepository;
    private SiteContentInterface $siteContent;
    private CategoryRepositoryInterface $categoryRepository;
    private PreparationRepositoryInterface $preparationRepository;

    public function __construct(AboutRepositoryInterface $aboutRepository, LanguageRepositoryInterface $languageRepository, SettingsRepositoryInterface $settingsRepository, SiteContentInterface $siteContent, CategoryRepositoryInterface $categoryRepository, PreparationRepositoryInterface $preparationRepository)
    {
        $this->aboutRepository = $aboutRepository;
        $this->languageRepository = $languageRepository;
        $this->settingsRepository = $settingsRepository;
        $this->siteContent = $siteContent;
        $this->categoryRepository = $categoryRepository;
        $this->preparationRepository = $preparationRepository;
        $this->viewFolder = 'Front/';
    }


    public function index(): View
    {

        $abouts = $this->aboutRepository->getAll();
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $allCategories = $this->categoryRepository->getAllActiveCategory();
        $viewData = [
            'viewFolder' => $this->viewFolder . "Home_v",
            'abouts' => $abouts,
            'languages' => $languages,
            'setting' => $setting,
            'siteContent' => $siteContent,
            'allCategories' => $allCategories,
        ];
        return view("{$viewData['viewFolder']}.index")->with($viewData);

    }

    public function about(): View
    {
        $abouts = $this->aboutRepository->getAll();
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $allCategories = $this->categoryRepository->getAllActiveCategory();


        $viewData = [
            'viewFolder' => $this->viewFolder . "About_v",
            'abouts' => $abouts,
            'languages' => $languages,
            'setting' => $setting,
            'siteContent' => $siteContent,
            'allCategories' => $allCategories,
        ];

        return view("{$viewData['viewFolder']}.index")->with($viewData);
    }

    public function preparation(): View
    {
        $abouts = $this->aboutRepository->getAll();
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $allCategories = $this->categoryRepository->getAllActiveCategory();
        $preparations = $this->preparationRepository->getAllPreparations();


        $viewData = [
            'viewFolder' => $this->viewFolder . "Preparation_v",
            'abouts' => $abouts,
            'languages' => $languages,
            'setting' => $setting,
            'siteContent' => $siteContent,
            'allCategories' => $allCategories,
            'preparations' => $preparations
        ];

        return view("{$viewData['viewFolder']}.index")->with($viewData);
    }

    public function preparationDetail(int $id): View
    {
        $abouts = $this->aboutRepository->getAll();
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $allCategories = $this->categoryRepository->getAllActiveCategory();
        $preparation = $this->preparationRepository->getPreparationById($id);

        $viewData = [
            'viewFolder' => $this->viewFolder . "PreparationDetails_v",
            'abouts' => $abouts,
            'languages' => $languages,
            'setting' => $setting,
            'siteContent' => $siteContent,
            'allCategories' => $allCategories,
            'preparation' => $preparation
        ];

        return view("{$viewData['viewFolder']}.index")->with($viewData);
    }

    public function allCategories(): View
    {
        $abouts = $this->aboutRepository->getAll();
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $allCategories = $this->categoryRepository->getAllActiveCategory();


        $viewData = [
            'viewFolder' => $this->viewFolder . "Category_v",
            'abouts' => $abouts,
            'languages' => $languages,
            'setting' => $setting,
            'siteContent' => $siteContent,
            'allCategories' => $allCategories,
        ];

        return view("{$viewData['viewFolder']}.index")->with($viewData);
    }

    public function categoryDetails(int $id): View
    {
        $abouts = $this->aboutRepository->getAll();
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $allCategories = $this->categoryRepository->getAllActiveCategory();// Menu-da gorunmesi ucun
        $categoryName = $this->categoryRepository->getCategoryById($id)->name;
        $preparations = $this->preparationRepository->getPreparationById($id);
        $preparationCategory = $this->preparationRepository->getPreparationsByCategoryId($id);

        $viewData = [
            'viewFolder' => $this->viewFolder . "Details_v",
            'abouts' => $abouts,
            'languages' => $languages,
            'setting' => $setting,
            'siteContent' => $siteContent,
            'categoryName' => $categoryName,
            'allCategories' => $allCategories,
            'preparations' => $preparations,
            'preparationCategory' => $preparationCategory

        ];

        return view("{$viewData['viewFolder']}.index")->with($viewData);
    }
}
