<?php

namespace App\Contracts;

interface LanguageRepositoryInterface
{

    public function getActiveLanguages():array;
    public function updateOrCreateByCode(string $code, array $name, bool $isActive = false);
    public  function count():int;


}
