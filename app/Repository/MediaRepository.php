<?php

namespace App\Repository;

use App\Contracts\MediaRepositoryInterface;
use App\Models\Media;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class MediaRepository implements MediaRepositoryInterface
{

    private Media $media;

    public function __construct(Media $media)
    {
        $this->media = $media;
    }

    public function getMediaByLimit(int $limit, int $page = 1): LengthAwarePaginator
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });
        return $this->media->newQuery()->latest()->paginate($limit);

    }
}
