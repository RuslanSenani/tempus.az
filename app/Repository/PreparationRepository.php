<?php

namespace App\Repository;

use App\Contracts\PreparationRepositoryInterface;
use App\Models\Preparation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PreparationRepository implements PreparationRepositoryInterface
{
    private Preparation $preparation;

    public function __construct(Preparation $preparation)
    {
        $this->preparation = $preparation;
    }

    public function getAllPreparations(): Collection
    {

        return $this->preparation->newQuery()
            ->where('is_active', 1)
            ->whereHas('category', function ($query) {
                $query->where('is_active', 1);
            })
            ->orderBy('sort_order')
            ->get();
    }

    public function getPreparationById($id)
    {

        return $this->preparation->newQuery()
            ->with(['category' => function ($query) {
                $query->where('is_active', 1);
            }])
            ->where('is_active', 1)
            ->whereHas('category', function ($query) {
                $query->where('is_active', 1);
            })
            ->where('id', $id)
            ->first();
    }

    public function getPreparationsByCategoryId($id)
    {

        return $this->preparation->newQuery()
            ->with('category')
            ->where('category_id', $id)
            ->where('is_active', 1)
            ->whereHas('category', function ($query) {
                $query->where('is_active', 1);
            })
            ->orderBy('sort_order')
            ->get();
    }


    public function getPreparationsByLimit(int $limit, int $page = 1): LengthAwarePaginator
    {

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        return $this->preparation->newQuery()
            ->where('is_active', 1)
            ->whereHas('category', function ($query) {
                $query->where('is_active', 1);
            })
            ->orderBy('sort_order')
            ->paginate($limit);
    }

    public function getCount(): int
    {
        return $this->preparation->newQuery()
            ->where('is_active', 1)
            ->whereHas('category', function ($query) {
                $query->where('is_active', 1);
            })
            ->count();
    }

    public function getPreparationBySlug($slug)
    {
        $locale = app()->getLocale();

        return $this->preparation->newQuery()
            ->where("slug->{$locale}", $slug)
            ->where('is_active', 1)
            ->firstOrFail();
    }

}
