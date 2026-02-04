<?php

namespace App\Repository;

use App\Contracts\StatisticRepositoryInterface;
use App\Models\Statistic;
use Illuminate\Database\Eloquent\Model;

class StatisticRepository implements StatisticRepositoryInterface
{
    private Statistic $statistic;

    public function __construct(Statistic $statistic)
    {
        $this->statistic = $statistic;
    }

    public function getIsActiveStatistics(): ?Model
    {
        return $this->statistic->newQuery()->where('is_active', '=', 1)->first();
    }
}
