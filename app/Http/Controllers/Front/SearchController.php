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


        $query = $request->get('query');
        $lang = app()->getLocale();
        if (!$query || mb_strlen($query) < 2) return response()->json([]);

        $searchTerm = "%" . mb_strtolower($query, 'UTF-8') . "%";

        // 1. Kateqoriyalarda axtarış
        $categories = \App\Models\PreparationCategory::where("name->{$lang}", 'LIKE', $searchTerm)
            ->where('is_active', 1)
            ->get()
            ->map(function ($item) {
                $item->search_type = 'category';
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

        $preparations = \App\Models\Preparation::with('category')
            ->where("name->{$lang}", 'LIKE', $searchTerm)
            ->where('is_active', 1) // Preparat özü aktiv olmalıdır
            // Əgər preparatın bağlı olduğu kateqoriyanın da aktiv olmasını istəyirsinizsə:
            ->whereHas('category', function ($q) {
                $q->where('is_active', 1);
            })
            ->get()
            ->map(function ($item) {
                $item->search_type = 'preparation';
                return $item;
            });

        // İkisini birləşdirib göndəririk
        return response()->json($categories->concat($preparations));



    }

}
