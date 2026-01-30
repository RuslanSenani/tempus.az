<?php

namespace App\Services;

use App\Contracts\ContactMessageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ContactService
{
    public function __construct(protected ContactMessageRepositoryInterface $repository)
    {
    }

    public function store(array $data): Model
    {
        return $this->repository->create($data);
    }

    public
    function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public
    function markAsRead(int $id): bool
    {
        return $this->repository->markAsRead($id);
    }
}

