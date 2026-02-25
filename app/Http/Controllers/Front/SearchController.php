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
            ->whereRaw('LOWER(name) LIKE ?', ["%{$query}%"])
            ->orWhereRaw('LOWER(title) LIKE ?', ["%{$query}%"])
            ->take(5)
            ->get(['id', 'name', 'title']);

        return response()->json($results);
    }

}
