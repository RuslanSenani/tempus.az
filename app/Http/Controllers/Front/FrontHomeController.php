<?php

namespace App\Http\Controllers\Front;

use App\Contracts\AboutRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\LanguageRepositoryInterface;
use App\Contracts\MediaRepositoryInterface;
use App\Contracts\MedicalInfoRepositoryInterface;
use App\Contracts\PartnersRepositoryInterface;
use App\Contracts\PreparationRepositoryInterface;
use App\Contracts\SettingsRepositoryInterface;
use App\Contracts\SiteContentInterface;
use App\Contracts\VacancyRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
    private PartnersRepositoryInterface $partnersRepository;
    private MedicalInfoRepositoryInterface $medicalInfoRepository;
    private MediaRepositoryInterface $mediaRepository;
    private VacancyRepositoryInterface $vacancyRepository;

    public function __construct(AboutRepositoryInterface $aboutRepository, LanguageRepositoryInterface $languageRepository, SettingsRepositoryInterface $settingsRepository, SiteContentInterface $siteContent, CategoryRepositoryInterface $categoryRepository, PreparationRepositoryInterface $preparationRepository, PartnersRepositoryInterface $partnersRepository, MedicalInfoRepositoryInterface $medicalInfoRepository, MediaRepositoryInterface $mediaRepository, VacancyRepositoryInterface $vacancyRepository)
    {
        $this->aboutRepository = $aboutRepository;
        $this->languageRepository = $languageRepository;
        $this->settingsRepository = $settingsRepository;
        $this->siteContent = $siteContent;
        $this->categoryRepository = $categoryRepository;
        $this->preparationRepository = $preparationRepository;
        $this->partnersRepository = $partnersRepository;
        $this->medicalInfoRepository = $medicalInfoRepository;
        $this->mediaRepository = $mediaRepository;
        $this->vacancyRepository = $vacancyRepository;
        $this->viewFolder = 'Front/';
    }


    public function index(): View
    {

        $abouts = $this->aboutRepository->getAll();
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $allCategories = $this->categoryRepository->getRandomActiveCategories();
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
        $allCategories = $this->categoryRepository->getRandomActiveCategories();


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

    public function preparation(Request $request, $page = 1): View
    {
        $abouts = $this->aboutRepository->getAll();
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $allCategories = $this->categoryRepository->getRandomActiveCategories();
        $preparations = $this->preparationRepository->getPreparationsByLimit(16, (int)$page);
        $preparations->setPath(url('preparations/page'));


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

    public function media(Request $request, $page = 1): View
    {
        $abouts = $this->aboutRepository->getAll();
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $allCategories = $this->categoryRepository->getRandomActiveCategories();
        $media = $this->mediaRepository->getMediaByLimit(12, (int)$page);
        $media->setPath(url('media/page'));


        $viewData = [
            'viewFolder' => $this->viewFolder . "Gallery_v",
            'abouts' => $abouts,
            'languages' => $languages,
            'setting' => $setting,
            'siteContent' => $siteContent,
            'allCategories' => $allCategories,
            'media' => $media
        ];

        return view("{$viewData['viewFolder']}.index")->with($viewData);
    }

    public function mediaDetails(int $id): View
    {
        $abouts = $this->aboutRepository->getAll();
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $allCategories = $this->categoryRepository->getRandomActiveCategories();
        $media = $this->mediaRepository->getMediaByLimit(12, (int)$page);
        $media->setPath(url('media/page'));


        $viewData = [
            'viewFolder' => $this->viewFolder . "GalleryDetails_v",
            'abouts' => $abouts,
            'languages' => $languages,
            'setting' => $setting,
            'siteContent' => $siteContent,
            'allCategories' => $allCategories,
            'media' => $media
        ];

        return view("{$viewData['viewFolder']}.index")->with($viewData);
    }

    public function medicalInfo(): View
    {
        $abouts = $this->aboutRepository->getAll();
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $allCategories = $this->categoryRepository->getRandomActiveCategories();
        $medicalInfos = $this->medicalInfoRepository->getAllMedicalInfo();

        $viewData = [
            'viewFolder' => $this->viewFolder . "MedicalInfo_v",
            'abouts' => $abouts,
            'languages' => $languages,
            'setting' => $setting,
            'siteContent' => $siteContent,
            'allCategories' => $allCategories,
            'medicalInfos' => $medicalInfos
        ];

        return view("{$viewData['viewFolder']}.index")->with($viewData);
    }

    public function medicalInfoDetails(int $id): View
    {
        $abouts = $this->aboutRepository->getAll();
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $allCategories = $this->categoryRepository->getRandomActiveCategories();
        $medicalInfo = $this->medicalInfoRepository->getMedicalInfoById($id);

        $viewData = [
            'viewFolder' => $this->viewFolder . "MedicalInfoDetails_v",
            'abouts' => $abouts,
            'languages' => $languages,
            'setting' => $setting,
            'siteContent' => $siteContent,
            'allCategories' => $allCategories,
            'medicalInfo' => $medicalInfo
        ];

        return view("{$viewData['viewFolder']}.index")->with($viewData);
    }

    public function preparationDetail(int $id): View
    {
        $abouts = $this->aboutRepository->getAll();
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $allCategories = $this->categoryRepository->getRandomActiveCategories();
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
        $categories = $this->categoryRepository->getAllActiveCategory();
        $allCategories = $this->categoryRepository->getRandomActiveCategories();


        $viewData = [
            'viewFolder' => $this->viewFolder . "Category_v",
            'abouts' => $abouts,
            'languages' => $languages,
            'setting' => $setting,
            'siteContent' => $siteContent,
            'categories' => $categories,
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
        $allCategories = $this->categoryRepository->getRandomActiveCategories();// Menu-da gorunmesi ucun
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

    public function partners(Request $request, $page = 1): View
    {
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $allCategories = $this->categoryRepository->getRandomActiveCategories();// Menu-da gorunmesi ucun
        $partners = $this->partnersRepository->getPartnersByLimit(16, (int)$page);
        $partners->setPath(url('partners/page'));
        $viewData = [
            'viewFolder' => $this->viewFolder . "Partners_v",
            'languages' => $languages,
            'setting' => $setting,
            'siteContent' => $siteContent,
            'allCategories' => $allCategories,
            'partners' => $partners,

        ];

        return view("{$viewData['viewFolder']}.index")->with($viewData);
    }

    public function contact(): View
    {
        $allCategories = $this->categoryRepository->getRandomActiveCategories();// Menu-da gorunmesi ucun
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $viewData = [
            'viewFolder' => $this->viewFolder . "Contact_v",
            'languages' => $languages,
            'setting' => $setting,
            'siteContent' => $siteContent,
            'allCategories' => $allCategories,


        ];

        return view("{$viewData['viewFolder']}.index")->with($viewData);
    }

    public function contactUs(Request $request)
    {


        $validation = $request->validate([
            'contact_name' => 'required|string|regex:/^[\p{L}\s]+$/u|max:100',
            'contact_email' => 'required|string|email|max:100',
            'contact_phone' => 'required|numeric|digits:10',
            'contact_message' => 'required|string|regex:/^[\p{L}\s]+$/u',
        ]);

        //dd($validation['contact_name']);

//        try {
//            $validatedData = $request->validate(
//                [
//                    'categoryName' => 'required|string|regex:/^[\p{L}\s]+$/u|max:100',
//                ]
//            );
//            $validatedData['name'] = $validatedData['categoryName'];
//            $this->categoryServices->saveOrRestore([['name', '=', $validatedData['categoryName']]], $validatedData);
//            return redirect()->route('categories.index');
//
//        } catch (\Exception $exception) {
//
//            $this->alertServices->error("Xəta", $exception->getMessage());
//
//            return redirect()->route('categories.create')->withInput();
//        }
    }

    public function vacancy(): View
    {
        $allCategories = $this->categoryRepository->getRandomActiveCategories();// Menu-da gorunmesi ucun
        $languages = $this->languageRepository->getAllLanguages();
        $setting = $this->settingsRepository->getSettings();
        $siteContent = $this->siteContent->getAllContent();
        $vacancies = $this->vacancyRepository->getVacancies();
        $viewData = [
            'viewFolder' => $this->viewFolder . "Vacancy_v",
            'languages' => $languages,
            'setting' => $setting,
            'siteContent' => $siteContent,
            'allCategories' => $allCategories,
            'vacancies' => $vacancies,


        ];

        return view("{$viewData['viewFolder']}.index")->with($viewData);
    }
}
