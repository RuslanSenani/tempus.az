<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface StatisticRepositoryInterface
{
    public function getIsActiveStatistics(): ?Model;
}
