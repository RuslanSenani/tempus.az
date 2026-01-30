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
        return $this->preparation->newQuery()->get();
    }

    public function getPreparationById($id)
    {
        return $this->preparation->newQuery()->with('category')->where('id', $id)->first();
    }

    public function getPreparationsByCategoryId($id)
    {
        return $this->preparation->newQuery()->with('category')->where('category_id', $id)->get();
    }


    public function getPreparationsByLimit(int $limit, int $page = 1): LengthAwarePaginator
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });
        return $this->preparation->newQuery()->latest()->paginate($limit);
    }
}
