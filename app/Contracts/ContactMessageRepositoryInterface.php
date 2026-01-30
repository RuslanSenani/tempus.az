<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ContactMessageRepositoryInterface
{
    public function create(array $data): Model;

    public function getAll(): Collection;

    public function findById(int $id): ?Model;

    public function markAsRead(int $id): bool;
}
