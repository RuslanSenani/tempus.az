<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function getAllActiveCategory(): Collection;

    public function getCategoryById($id);

    public function getRandomActiveCategories($limit): Collection;

}
