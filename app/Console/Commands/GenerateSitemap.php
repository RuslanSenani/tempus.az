<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\Sitemap;
use App\Models\{Language, Preparation, PreparationCategory};

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sayt xəritəsini yenidən yaradır';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $sitemap = Sitemap::create();

        // 1. Bazadan yalnız aktiv olan dillərin kodlarını çəkirik
        // Əgər sütun adı fərqlidirsə (məs. 'iso'), 'code' yerinə onu yaz.
        $locales = Language::where('is_active', 1)->pluck('code')->toArray();

        // Əgər baza boşdursa və ya nəsə xəta olarsa, fallback olaraq default dili götürək
        if (empty($locales)) {
            $locales = [config('app.locale')];
        }

        foreach ($locales as $locale) {

            // 2. Statik Səhifələr
            $staticRoutes = [
                'home' => 1.0,
                'about-us' => 0.8,
                'contact' => 0.8,
                'vacancy' => 0.7,
                'categories' => 0.7,
                'preparation' => 0.9,
                'partners' => 0.7,
                'media' => 0.7,
            ];

            foreach ($staticRoutes as $routeName => $priority) {
                try {
                    $sitemap->add(
                        Url::create(route($routeName, ['locale' => $locale]))
                            ->setPriority($priority)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    );
                } catch (\Exception $e) {
                    $this->error("Xəta: {$routeName} marşrutu {$locale} dili üçün tapılmadı.");
                }
            }

            // 3. Dinamik Preparatlar
            Preparation::where('is_active', 1)
                ->whereNotNull('category_id') // Kateqoriyası mütləq olmalıdır (NULL olmasın)
                ->has('category') // Belə bir kateqoriya münasibəti (relationship) həqiqətən mövcud olmalıdır
                ->whereHas('category', function ($query) {
                    $query->where('is_active', 1); // Bağlı olduğu kateqoriya da mütləq aktiv olmalıdır
                })
                ->get()
                ->each(function ($item) use ($sitemap, $locale) {
                    $slug = $item->getTranslation('slug', $locale);
                    if ($slug) {
                        $sitemap->add(
                            Url::create(route('preparation-detail', ['locale' => $locale, 'slug' => $slug]))
                                ->setPriority(0.9)
                                ->setLastModificationDate($item->updated_at ?? now())
                        );
                    }
                });

            // 4. Dinamik Kateqoriyalar (Yalnız aktiv olan və daxilində aktiv preparat olanlar)
            PreparationCategory::where('is_active', 1)
                ->has('preparations', '>', 0)
                ->whereHas('preparations', function ($query) {
                    $query->where('is_active', 1);
                })
                ->get()
                ->each(function ($cat) use ($sitemap, $locale) {
                    $slug = $cat->getTranslation('slug', $locale);
                    if ($slug) {
                        $sitemap->add(
                            Url::create(route('category-details', ['locale' => $locale, 'slug' => $slug]))
                                ->setPriority(0.8)
                        );
                    }
                });
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
        $this->info('Sitemap.xml bazadakı dillərə uyğun olaraq uğurla yaradıldı!');
    }
}
