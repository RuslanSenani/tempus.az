<?php

namespace App\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface PartnersRepositoryInterface
{
    public function getPartnersByLimit(int $limit, int $page = 1): LengthAwarePaginator;

    public function getCount(): int;

}
