<?php

namespace App\Observers;

use App\Contracts\LanguageRepositoryInterface;
use App\Contracts\SiteContentInterface;
use App\Models\SiteContent;
use Illuminate\Support\Facades\File;

class SiteContentObserver
{

    protected LanguageRepositoryInterface $languageRepository;
    protected SiteContentInterface $siteContentRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository, SiteContentInterface $siteContentRepository)
    {
        $this->languageRepository = $languageRepository;
        $this->siteContentRepository = $siteContentRepository;
    }

    /**
     * Hər dəfə yeni sətir daxil ediləndə və ya yenilənəndə faylı yenilə.
     */
    public function saved(SiteContent $siteContent)
    {
        $this->updateJsonFile();
    }

    /**
     * Sətir silinəndə də faylı yenilə.
     */
//    public function deleted(SiteContent $siteContent)
//    {
//        $this->updateJsonFile();
//    }


    protected function updateJsonFile()
    {
        $path = lang_path('siteContent.json');

        $allContents =$this->siteContentRepository->getAllContents();
        $finalData = [];

        foreach ($allContents as $content) {
            $val = $content->value;

            if (is_string($val)) {
                $val = json_decode($val, true);
            }

            if (empty($val)) {
                $raw = $content->getRawOriginal('value');
                $val = is_string($raw) ? json_decode($raw, true) : $raw;
            }

            $finalData[$content->key] = $val ?: [];
        }

        $jsonString = json_encode($finalData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        File::put($path, $jsonString);
    }




}
