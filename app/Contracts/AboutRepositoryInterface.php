<?php

namespace App\Contracts;



use Illuminate\Database\Eloquent\Collection;

interface AboutRepositoryInterface
{

    public function getAll(): Collection;


}
