<?php

namespace App\Http\Controllers\Front;

use App\Contracts\SiteContentInterface;
use App\Http\Controllers\Controller;
use App\Models\Preparation;
use App\Models\PreparationCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    private SiteContentInterface $siteContent;

    public function __construct(SiteContentInterface $siteContent)
    {
        $this->siteContent = $siteContent;
    }


    public function liveSearch(Request $request): JsonResponse
    {
//
//        $query = $request->get('query');
//        $lang = app()->getLocale(); // Mövcud dil (az, en, ru və s.)
//
//        if (!$query || mb_strlen($query) < 2) {
//            return response()->json([]);
//        }
//
//        // Axtarış sözünü kiçik hərflərə çeviririk
//        $searchTerm = mb_strtolower($query, 'UTF-8');
//
//        $results = Preparation::with('category')
//            ->where(function ($q) use ($searchTerm, $lang) {
//                // 1. Preparatın adı (JSON) daxilində axtarış
//                $q->where("name->{$lang}", 'LIKE', "%{$searchTerm}%")
//                    ->orWhere("title->{$lang}", 'LIKE', "%{$searchTerm}%")
//
//                    // 2. Aid olduğu kateqoriyanın adı (JSON) daxilində axtarış
//                    ->orWhereHas('category', function ($subQuery) use ($searchTerm, $lang) {
//                        $subQuery->where("name->{$lang}", 'LIKE', "%{$searchTerm}%");
//                    });
//            })
//            ->take(10)
//            ->get();
//
//        return response()->json($results);


        $query = $request->get('query');
        $lang = app()->getLocale();
        if (!$query || mb_strlen($query) < 2) return response()->json([]);

        $searchTerm = "%" . mb_strtolower($query, 'UTF-8') . "%";

        // 1. Kateqoriyalarda axtarış
        $categories = \App\Models\PreparationCategory::where("name->{$lang}", 'LIKE', $searchTerm)
            ->get()
            ->map(function ($item) {
                $item->search_type = 'category'; // JS üçün nişan
                return $item;
            });

        // 2. Preparatlarda axtarış
        $preparations = \App\Models\Preparation::with('category')
            ->where("name->{$lang}", 'LIKE', $searchTerm)
            ->get()
            ->map(function ($item) {
                $item->search_type = 'preparation'; // JS üçün nişan
                return $item;
            });

        // İkisini birləşdirib göndəririk
        return response()->json($categories->concat($preparations));


//        $query = $request->get('query');
//        $siteContent = $this->siteContent->getAllContent();
//        if (!$query || mb_strlen($query) < 2) {
//            return response()->json([]);
//        }
//
//        $msg = $siteContent['home_not_found_text']->value ?? 'Heç bir nəticə tapılmadı';
//        $results = Preparation::query()
//            ->whereRaw('LOWER(name) LIKE ?', ["%{$query}%"])
//            ->orWhereRaw('LOWER(title) LIKE ?', ["%{$query}%"])
//            ->take(5)
//            ->get(['id', 'name', 'title']);
//
//        return response()->json($results)->header('X-Search-Message', base64_encode($msg));


    }

}
