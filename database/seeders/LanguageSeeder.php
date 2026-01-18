<?php

namespace Database\Seeders;

use App\Contracts\LanguageRepositoryInterface;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{

    protected LanguageRepositoryInterface $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $this->languageRepository->updateOrCreateByCode(
            code: 'AZ',
            name: array('AZ' => 'Azərbaycan'),
            isActive: true
        );
    }
}
