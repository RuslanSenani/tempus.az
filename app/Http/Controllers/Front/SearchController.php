<?php

namespace App\Http\Controllers\Front;

use App\Contracts\SiteContentInterface;
use App\Http\Controllers\Controller;
use App\Models\Preparation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

        if (!$query || mb_strlen($query) < 2) {
            return response()->json([]);
        }

        $lang = app()->getLocale() ?: 'az';

        $results = Preparation::query()
            ->where(function ($q) use ($query, $lang) {
                // JSON_UNQUOTE və JSON_EXTRACT-ı dırnaqsız (sadə) şəkildə yazırıq
                $q->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.$lang')) LIKE ?", ["%{$query}%"])
                    ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(title, '$.$lang')) LIKE ?", ["%{$query}%"])
                    ->orWhere('slug', 'LIKE', "%{$query}%");
            })
            ->take(5)
            ->get(['id', 'name', 'title']);

        return response()->json($results);
    }


//    public function liveSearch(Request $request): JsonResponse
//    {
//        $siteContent = $this->siteContent->getAllContent();
//
//        $query = $request->get('query');
//
//        $results = Preparation::where('name', 'LIKE', "%{$query}%")
//            ->orWhere('title', 'LIKE', "%{$query}%")
//            ->orWhere('slug', 'LIKE', "%{$query}%")
//            ->take(5)
//            ->get(['id', 'name', 'title']);
//
//
//        return response()->json($results);
//    }
}
