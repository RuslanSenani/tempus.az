<?php

namespace App\Repository;

use App\Contracts\SettingsRepositoryInterface;
use App\Models\Setting;

class SettingsRepository implements SettingsRepositoryInterface
{
    private Setting $settingModel;

    public function __construct(Setting $settingModel)
    {
        $this->settingModel = $settingModel;
    }

    public function getSettings(): ?Setting
    {
        return $this->settingModel->newQuery()->first();
    }
}
