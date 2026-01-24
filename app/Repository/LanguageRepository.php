<?php

namespace App\Repository;

use App\Contracts\LanguageRepositoryInterface;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class LanguageRepository implements LanguageRepositoryInterface
{
    private Language $languageModel;

    public function __construct(Language $languageModel)
    {
        $this->languageModel = $languageModel;
    }

    public function getActiveLanguages(): array
    {
        return $this->languageModel->newQuery()->where('is_active', true)->pluck('name', 'code')->toArray();
    }


    public function updateOrCreateByCode(string $code, array $name, bool $isActive = false)
    {
        return $this->languageModel->newQuery()->updateOrCreate(
            ['code' => $code],
            ['name' => $name, 'is_active' => $isActive]
        );
    }

    public function count(): int
    {
        return $this->languageModel->newQuery()->count();
    }

    public function getAllLanguages(): Collection
    {
        return Cache::rememberForever('active_languages', function () {
            return $this->languageModel->newQuery()
                ->where('is_active', true)
                ->get();
        });
    }

    public function getActiveLocales()
    {
        // Bazadan yalnız kodları (az, en, ru) massiv şəklində qaytarır
        return $this->languageModel->newQuery()->where('is_active', true)->pluck('code')->toArray();
    }
}
