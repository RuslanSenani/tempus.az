<?php

namespace App\Repository;

use App\Contracts\CategoryRepositoryInterface;
use App\Models\PreparationCategory;
use Illuminate\Database\Eloquent\Collection;


class CategoryRepository implements CategoryRepositoryInterface
{

    private PreparationCategory $category;

    public function __construct(PreparationCategory $category)
    {
        $this->category = $category;
    }

    public function getAllActiveCategory(): Collection
    {
        return $this->category->newQuery()->with('preparations')->withCount('preparations')->where('is_active', 1)->get();

    }

    public function getRandomActiveCategories($limit = 5): Collection
    {
        return $this->category->newQuery()
            ->with(['preparations' => function ($query) use ($limit) {
                $query->limit($limit);
            }])
            ->withCount('preparations')
            ->where('is_active', 1)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    public function getCategoryById($id)
    {
        return $this->category->newQuery()->findOrFail($id)->first();
    }
}
