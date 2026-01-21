<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface SettingsRepositoryInterface
{
    public function getSettings(): ?Model;
}
