<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface PreparationRepositoryInterface
{

    public function getAllPreparations(): Collection;

    public function getPreparationById($id);

    public function getPreparationsByCategoryId($id);
    public function getPartnersByLimit(int $limit, int $page = 1): LengthAwarePaginator;

}
