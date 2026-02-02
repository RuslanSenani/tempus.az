<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface VacancyRepositoryInterface
{

    public function getVacancies(): Model;


}
