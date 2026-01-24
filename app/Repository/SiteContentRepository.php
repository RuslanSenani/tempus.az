<?php

namespace App\Repository;

use App\Contracts\SiteContentInterface;
use App\Models\SiteContent;
use Illuminate\Container\Attributes\Log;

class SiteContentRepository implements SiteContentInterface
{
    private SiteContent $siteContent;

    public function __construct(SiteContent $siteContent)
    {
        $this->siteContent = $siteContent;
    }

//    public function translate(string $key): string
//    {
//        $locale = app()->getLocale();
//
//        $row = $this->siteContent->newQuery()->where('key', $key)->first();
//
//        if (!$row) {
//            return $key;
//        }
//
//        $values = $row->value;
//
//
//
//        return $values[$locale] ?? $values['en'] ?? $key;
//    }
    public function getAllContent()
    {
        return $this->siteContent->all()->keyBy('key');
    }
}
