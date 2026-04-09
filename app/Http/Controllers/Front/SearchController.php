<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Contracts\SiteContentInterface;
use App\Models\{
    Preparation,
    PreparationCategory
};
use Illuminate\Http\{
    JsonResponse,
    Request
};


class SearchController extends Controller
{
    private SiteContentInterface $siteContent;

    public function __construct(SiteContentInterface $siteContent)
    {
        $this->siteContent = $siteContent;
    }


    public function liveSearch($locale, Request $request): JsonResponse
    {


        $query = $request->get('query');
        $lang = $locale;

        if (!$query || mb_strlen($query) < 2) return response()->json([]);

        $searchTerm = "%" . mb_strtolower($query, 'UTF-8') . "%";

        // 1. Kateqoriyalarda axtarış
        $categories = PreparationCategory::where("slug->{$lang}", 'LIKE', $searchTerm)
            ->where('is_active', 1)
            ->get()
            ->map(function ($item) use ($lang) {
                $item->search_type = 'category';
                // JS üçün cari dildəki slug-ı string olaraq hazırlayırıq
                $item->slug_text = $item->getTranslation('slug', $lang);
                return $item;
            });

        // 2. Preparatlarda axtarış
        $preparations = Preparation::with('category')
            ->where("slug->{$lang}", 'LIKE', $searchTerm)
            ->where('is_active', 1)
            ->whereHas('category', function ($q) {
                $q->where('is_active', 1);
            })
            ->get()
            ->map(function ($item) use ($lang) {
                $item->search_type = 'preparation';
                $item->slug_text = $item->getTranslation('slug', $lang);
                return $item;
            });

        return response()->json($categories->concat($preparations));

//        $query = $request->get('query');
//        $lang = app()->getLocale();
//        if (!$query || mb_strlen($query) < 2) return response()->json([]);
//
//        $searchTerm = "%" . mb_strtolower($query, 'UTF-8') . "%";
//
//        // 1. Kateqoriyalarda axtarış
//        $categories = \App\Models\PreparationCategory::where("name->{$lang}", 'LIKE', $searchTerm)
//            ->where('is_active', 1)
//            ->get()
//            ->map(function ($item) {
//                $item->search_type = 'category';
//                return $item;
//            });
//
//        // 2. Preparatlarda axtarış
//        $preparations = \App\Models\Preparation::with('category')
//            ->where("name->{$lang}", 'LIKE', $searchTerm)
//            ->get()
//            ->map(function ($item) {
//                $item->search_type = 'preparation'; // JS üçün nişan
//                return $item;
//            });
//
//        $preparations = \App\Models\Preparation::with('category')
//            ->where("name->{$lang}", 'LIKE', $searchTerm)
//            ->where('is_active', 1) // Preparat özü aktiv olmalıdır
//            // Əgər preparatın bağlı olduğu kateqoriyanın da aktiv olmasını istəyirsinizsə:
//            ->whereHas('category', function ($q) {
//                $q->where('is_active', 1);
//            })
//            ->get()
//            ->map(function ($item) {
//                $item->search_type = 'preparation';
//                return $item;
//            });
//
//        // İkisini birləşdirib göndəririk
//        return response()->json($categories->concat($preparations));


    }

}
