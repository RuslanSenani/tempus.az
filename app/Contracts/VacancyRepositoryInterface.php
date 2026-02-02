<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface VacancyRepositoryInterface
{

    public function getVacancies(): Collection;


}
