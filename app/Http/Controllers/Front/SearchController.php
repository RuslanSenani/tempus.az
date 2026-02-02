<?php

namespace App\Http\Controllers\Front;

use App\Contracts\SiteContentInterface;
use App\Http\Controllers\Controller;
use App\Models\Preparation;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private SiteContentInterface $siteContent;

    public function __construct(SiteContentInterface $siteContent)
    {
        $this->siteContent = $siteContent;
    }

    public function liveSearch(Request $request)
    {
        $siteContent = $this->siteContent->getAllContent();


        $query = $request->get('query');

        $results = Preparation::where('name', 'LIKE', "%{$query}%")
            ->orWhere('title', 'LIKE', "%{$query}%")
            ->orWhere('slug', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get(['id', 'name', 'title']);
        return response()->json($results);
    }
}
