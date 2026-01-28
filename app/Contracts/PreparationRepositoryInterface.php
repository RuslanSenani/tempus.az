<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface PreparationRepositoryInterface
{
    public function getAllPreparations(): Collection;

    public function getPreparationById($id);
    public   function  getPreparationsByCategoryId($id);
}
