<?php

namespace App\Repository;

use App\Contracts\PartnersRepositoryInterface;
use App\Models\Partner;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PartnersRepository implements PartnersRepositoryInterface
{
    private Partner $partner;

    public function __construct(Partner $partner)
    {
        $this->partner = $partner;
    }


    public function getPartnersByLimit(int $limit, int $page = 1): LengthAwarePaginator
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });
        return $this->partner->newQuery()->latest()->paginate($limit);
    }
}
