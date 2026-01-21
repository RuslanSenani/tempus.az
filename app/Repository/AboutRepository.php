<?php

namespace App\Repository;

use App\Contracts\AboutRepositoryInterface;
use App\Models\About;
use  Illuminate\Database\Eloquent\Collection;

class AboutRepository implements AboutRepositoryInterface
{

    private About $aboutModel;

    public function __construct(About $aboutModel)
    {
        $this->aboutModel = $aboutModel;
    }

    public function getAll(): Collection
    {
        return $this->aboutModel->newQuery()->get();
    }
}
