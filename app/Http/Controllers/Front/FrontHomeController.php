<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Contracts\{
    AboutRepositoryInterface,
    CategoryRepositoryInterface,
    MediaRepositoryInterface,
    PartnersRepositoryInterface,
    PreparationRepositoryInterface,
    StatisticRepositoryInterface,
    VacancyRepositoryInterface,
};
use App\Models\{Region, Site_Settings};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Cache, Http};
use Illuminate\View\View;

class FrontHomeController extends Controller
{
    private string $viewFolder = 'Front/';
    private AboutRepositoryInterface $aboutRepository;
    private CategoryRepositoryInterface $categoryRepository;
    private PreparationRepositoryInterface $preparationRepository;
    private PartnersRepositoryInterface $partnersRepository;
    private MediaRepositoryInterface $mediaRepository;
    private VacancyRepositoryInterface $vacancyRepository;
    private StatisticRepositoryInterface $statisticRepository;

    public function __construct(
        AboutRepositoryInterface       $aboutRepository,
        CategoryRepositoryInterface    $categoryRepository,
        PreparationRepositoryInterface $preparationRepository,
        PartnersRepositoryInterface    $partnersRepository,
        MediaRepositoryInterface       $mediaRepository,
        VacancyRepositoryInterface     $vacancyRepository,
        StatisticRepositoryInterface   $statisticRepository
    )
    {
        $this->aboutRepository = $aboutRepository;
        $this->categoryRepository = $categoryRepository;
        $this->preparationRepository = $preparationRepository;
        $this->partnersRepository = $partnersRepository;
        $this->mediaRepository = $mediaRepository;
        $this->vacancyRepository = $vacancyRepository;
        $this->statisticRepository = $statisticRepository;
    }

    // $locale parametri bütün metodlara əlavə edildi ki, 404 xətası və parametr sürüşməsi olmasın.

    public function index($locale): View
    {
        $viewData = [
            'viewFolder' => $this->viewFolder . "Home_v",
            'abouts' => $this->aboutRepository->getAll(),
            'categories' => $this->categoryRepository->getRandomActiveCategories(9),
            'preparations' => $this->preparationRepository->getPreparationsByLimit(4),
            'partners' => $this->partnersRepository->getPartnersByLimit(4),
            'statistic' => $this->statisticRepository->getIsActiveStatistics(),
            'media' => $this->mediaRepository->getMediaByLimit(12),
            'regions' => Region::first('names')?->names ?? [],
        ];
        return view("{$viewData['viewFolder']}.index")->with($viewData);
    }

    public function about($locale): View
    {
        $viewData = [
            'viewFolder' => $this->viewFolder . "About_v",
            'abouts' => $this->aboutRepository->getAll(),
            'categories' => $this->categoryRepository->getAllActiveCategory(),
            'regions' => Region::first('names')?->names ?? [],
        ];
        return view("{$viewData['viewFolder']}.index")->with($viewData);
    }

    public function preparation($locale, $page = 1): View
    {
        $preparations = $this->preparationRepository->getPreparationsByLimit(16, (int)$page);
        // Pagination linklərində dili qorumaq üçün:
        $preparations->setPath(url($locale . '/preparation/page'));

        return view($this->viewFolder . "Preparation_v.index", compact('preparations'));
    }

    public function media($locale, $page = 1): View
    {
        $media = $this->mediaRepository->getMediaByLimit(12, (int)$page);
        $media->setPath(url($locale . '/media/page'));

        $instaData = $this->getInstagramData();

        return view($this->viewFolder . "Gallery_v.index", [
            'media' => $media,
            'posts' => $instaData['posts'],
            'next_cursor' => $instaData['next_cursor']
        ]);
    }

    public function preparationDetail($locale, $slug): View
    {
        // Slug-ın sonundakı ID-ni götürürük
        $preparation = $this->preparationRepository->getPreparationBySlug($slug);

        $preparation = $this->preparationRepository->getPreparationById($preparation->id);

        if (!$preparation) abort(404);

        return view($this->viewFolder . "PreparationDetails_v.index", compact('preparation'));
    }

    public function allCategories($locale): View
    {
        $categories = $this->categoryRepository->getAllActiveCategory();
        return view($this->viewFolder . "Category_v.index", compact('categories'));
    }

    public function categoryDetails($locale, $slug): View
    {

        $category = $this->categoryRepository->getCategoryBySlug($slug);

        if (!$category) {
            abort(404);
        }

        $id = $category->id;
        $preparationCategory = $this->preparationRepository->getPreparationsByCategoryId($id);

        $viewData = [
            'viewFolder' => $this->viewFolder . "Details_v",
            'categoryName' => $category->name,
            'preparationCategory' => $preparationCategory,
        ];


        return view("{$viewData['viewFolder']}.index")->with($viewData);
    }

//    public function categoryDetails($locale, $slug): View
//    {
//        // Kateqoriyanı slug-a görə tapırıq
//        $category = $this->categoryRepository->getCategoryBySlug($slug);
//
//        if (!$category) abort(404);
//
//        $id = $category->id;
//        $viewData = [
//            'categoryName' => $category->name,
//            'preparations' => $this->preparationRepository->getPreparationById($id),
//            'preparationCategory' => $this->preparationRepository->getPreparationsByCategoryId($id)
//        ];
//
//        return view($this->viewFolder . "Details_v.index", $viewData);
//    }

    public function partners($locale, $page = 1): View
    {
        $partners = $this->partnersRepository->getPartnersByLimit(16, (int)$page);
        $partners->setPath(url($locale . '/partners/page'));

        return view($this->viewFolder . "Partners_v.index", compact('partners'));
    }

    public function contact($locale): View
    {
        return view($this->viewFolder . "Contact_v.index");
    }

    public function vacancy($locale): View
    {
        $vacancy = $this->vacancyRepository->getVacancies();
        return view($this->viewFolder . "Vacancy_v.index", compact('vacancy'));
    }

    // Instagram məntiqi olduğu kimi qalır
    private function getInstagramData($after = null, $limit = 28)
    {
        $setting = Site_Settings::first('key_value');
        $token = $setting->key_value['instagram_access_token'] ?? null;

        if (!$token) return ['posts' => [], 'next_cursor' => null];

        $cacheKey = 'insta_feed_' . ($after ?: 'initial');
        return Cache::remember($cacheKey, 86400, function () use ($limit, $token, $after) {
            $url = "https://graph.instagram.com/me/media?fields=id,caption,media_type,media_url,permalink,thumbnail_url,timestamp&limit={$limit}&access_token={$token}";

            if ($after) $url .= "&after={$after}";

            $response = Http::get($url);

            if ($response->successful()) {
                $resJson = $response->json();
                $posts = collect($resJson['data'] ?? [])->map(function ($post) {
                    $post['permalink'] = str_replace(['/reel/', '/reels/'], '/p/', $post['permalink'] ?? '');
                    $post['imageSrc'] = ($post['media_type'] === 'VIDEO')
                        ? ($post['thumbnail_url'] ?? $post['media_url'])
                        : $post['media_url'];
                    return $post;
                })->all();

                return [
                    'posts' => $posts,
                    'next_cursor' => $resJson['paging']['cursors']['after'] ?? null
                ];
            }
            return ['posts' => [], 'next_cursor' => null];
        });
    }

    public function instagramFeed(Request $request)
    {
        $after = $request->get('after');
        $data = $this->getInstagramData($after, 50);
        return response()->json($data);
    }
}
