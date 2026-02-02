<?php

namespace App\Repository;

use App\Contracts\VacancyRepositoryInterface;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Collection;

class VacancyRepository implements VacancyRepositoryInterface
{
    private Vacancy $vacancyModel;

    public function __construct(Vacancy $vacancyModel)
    {
        $this->vacancyModel = $vacancyModel;
    }


    public function getVacancies(): Vacancy
    {
        return $this->vacancyModel->newQuery()->first();
    }


}
