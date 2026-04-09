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

        return $this->category->newQuery()->with('preparations')->withCount('preparations')->where('is_active', 1)->orderBy('sort_order', 'asc')->get();

    }

    public function getRandomActiveCategories($limit = 30): Collection
    {
        return $this->category->newQuery()
            ->with(['preparations' => function ($query) use ($limit) {
                $query->limit($limit);
            }])
            ->withCount('preparations')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->limit($limit)
            ->inRandomOrder()
            ->get();

    }

    public function getCategoryBySlug($slug)
    {
        $locale = app()->getLocale();

        return $this->category->newQuery()
            ->where("slug->{$locale}", $slug)
            ->where('is_active', 1)
            ->firstOrFail();
    }

    public function getCategoryById($id)
    {
        return $this->category->newQuery()->findOrFail($id);
    }
}
