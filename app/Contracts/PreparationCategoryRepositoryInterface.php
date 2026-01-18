<?php

namespace App\Contracts;

interface PreparationCategoryRepositoryInterface
{
    public function getPreparationCategoriesByLang(int $langId): array;

    public function getPreparationCategory(): array;
}
