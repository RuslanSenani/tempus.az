<?php

namespace App\Repository;

use App\Contracts\PreparationCategoryRepositoryInterface;
use App\Models\PreparationCategory;

class PreparationCategoryRepository implements PreparationCategoryRepositoryInterface
{
    private PreparationCategory $preparationCategory;

    public function __construct(PreparationCategory $preparationCategory)
    {
        $this->preparationCategory = $preparationCategory;
    }

    public function getPreparationCategoriesByLang(int $langId): array
    {
        return $this->preparationCategory->newQuery()
            ->where('is_active', true)
            ->where('lang_id', $langId)
            ->pluck('name', 'id')
            ->toArray();

    }

    public function getPreparationCategory(): array
    {
        return $this->preparationCategory
            ->newQuery()
            ->where('is_active', true)
            ->pluck('name', 'id')
            ->toArray();
    }
}
