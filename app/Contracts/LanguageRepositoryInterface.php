<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface LanguageRepositoryInterface
{

    public function getActiveLanguages(): array;

    public function  getDefaultLanguage();

    public function updateOrCreateByCode(string $code, array $name, bool $isActive = false);

    public function count(): int;

    public function getAllLanguages(): Collection;

    public function getActiveLocales();


}
