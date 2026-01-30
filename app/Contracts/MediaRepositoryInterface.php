<?php

namespace App\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface MediaRepositoryInterface
{
    public function getMediaByLimit(int $limit, int $page = 1): LengthAwarePaginator;

}
