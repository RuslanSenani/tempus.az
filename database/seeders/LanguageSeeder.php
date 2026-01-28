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
        $languagesData = [
            'az' => [
                'az' => 'Azərbaycan',
                'en' => 'Azerbaijani',
                'ru' => 'Азербайджанский'
            ],
            'en' => [
                'az' => 'İngilis',
                'en' => 'English',
                'ru' => 'Английский'
            ],
            'ru' => [
                'az' => 'Rus',
                'en' => 'Russian',
                'ru' => 'Русский'
            ],
        ];

        foreach ($languagesData as $code => $translations) {
            $this->languageRepository->updateOrCreateByCode(
                code: $code,
                name: $translations,
                isActive: true
            );
        }
    }
}
