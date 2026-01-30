<?php

namespace App\Repository;

use App\Contracts\ContactMessageRepositoryInterface;
use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Collection;

class ContactMessageRepository implements ContactMessageRepositoryInterface
{
    private ContactMessage $model;

    public function __construct(ContactMessage $contactMessage)
    {
        $this->model = $contactMessage;
    }

    public function create(array $data): ContactMessage
    {
        return $this->model->create($data);
    }

    public function getAll(): Collection
    {
        return $this->model->latest()->get();
    }

    public function findById(int $id): ?ContactMessage
    {
        return $this->model->find($id);
    }

    public function markAsRead(int $id): bool
    {
        $message = $this->findById($id);

        if (!$message) {
            return false;
        }

        $message->update(['is_read' => true]);

        return true;
    }
}
