<?php

namespace App\Repository;

use App\Contracts\VacancyApplicationRepositoryInterface;
use App\Models\VacancyApplication;

class VacancyApplicationRepository implements VacancyApplicationRepositoryInterface
{
    private VacancyApplication $vacancyApplication;

    public function __construct(VacancyApplication $vacancyApplication)
    {
        $this->vacancyApplication = $vacancyApplication;
    }

    public function create(array $data)
    {
        return $this->vacancyApplication->newQuery()->create($data);
    }
}
