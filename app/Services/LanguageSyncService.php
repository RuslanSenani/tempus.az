<?php

namespace App\Services;

use App\Models\SiteContent;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LanguageSyncService
{
    public function syncFromJson(): int
    {
        $path = base_path("lang/siteContent.json");

        if (!File::exists($path)) {
            throw new \Exception("Fayl tapılmadı.");
        }

        $translations = json_decode(File::get($path), true);

        foreach ($translations as $key => $value) {
            // UpdateOrCreate: Key varsa dəyəri yenilə, yoxdursa yarat
            SiteContent::updateOrCreate(
                ['key' => Str::slug($key, '_')],
                ['value' => $value]
            // Spatie translatable istifadə edirsənsə, model daxilində setTranslation işləyəcək
            );
        }

        return count($translations);
    }
}
