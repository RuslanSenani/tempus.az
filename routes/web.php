<?php

use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\FrontHomeController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\Front\VacancyApplicationController;
use App\Http\Middleware\SetLocaleLanguage;
use Illuminate\Support\Facades\Route;

// 1. Dil prefiksi yoxdursa, bazadakı default dilə (və ya config-dəkinə) yönləndir
Route::get('/', function () {
    return redirect('/' . app()->getLocale());
});

// 2. Dil qrupu
Route::group([
    'prefix' => '{locale}',
    'where' => [
        'locale' => '[a-z]{2}' // Prefiksin yalnız 2 hərfdən ibarət (az, en, ru) olmasını sığortalayırıq
    ],
    'middleware' => SetLocaleLanguage::class
], function () {

    // Ana Səhifə
    Route::get('/', [FrontHomeController::class, 'index'])->name('home');

    // Statik Səhifələr
    Route::get('/about-us', [FrontHomeController::class, 'about'])->name('about-us');
    Route::get('/contact', [FrontHomeController::class, 'contact'])->name('contact');
    Route::get('/vacancy', [FrontHomeController::class, 'vacancy'])->name('vacancy');

    // Kateqoriya Ümumi Siyahı
    Route::get('/categories', [FrontHomeController::class, 'allCategories'])->name('categories');

    // Preparatlar (Məhsullar)
    Route::get('/preparation', [FrontHomeController::class, 'preparation'])->name('preparation');
    Route::get('/preparation/page/{page}', [FrontHomeController::class, 'preparation'])->name('preparation.page');
    Route::get('/preparation/{slug}', [FrontHomeController::class, 'preparationDetail'])->name('preparation-detail');

    // Partnyorlar
    Route::get('/partners', [FrontHomeController::class, 'partners'])->name('partners');
    Route::get('/partners/page/{page}', [FrontHomeController::class, 'partners'])->name('partners.page');

    // Media və Qalereya
    Route::get('/media', [FrontHomeController::class, 'media'])->name('media');
    Route::get('/media/page/{page}', [FrontHomeController::class, 'media'])->name('media.page');
    Route::get('/media-details/{id}', [FrontHomeController::class, 'mediaDetails'])->name('media-details');
    Route::get('/instagram-feed', [FrontHomeController::class, 'instagramFeed'])->name('instagram.ajax');

    // Post Sorğuları (Formlar)
    Route::post('/contact-us', [FrontHomeController::class, 'contactUs'])->name('contact-us');
    Route::post('/contact-store', [ContactController::class, 'store'])->name('contact.store')->middleware('throttle:3,1');
    Route::post('/vacancy-store', [VacancyApplicationController::class, 'store'])->name('vacancy.store')->middleware('throttle:3,1');
    Route::post('/vacancy-application', [VacancyApplicationController::class, 'store'])->name('vacancy.store_full');

    // Axtarış
    Route::get('/live-search', [SearchController::class, 'liveSearch'])->name('live.search');

    // --- ƏN VACİB HİSSƏ ---
    // Dinamik Kateqoriya Slug-ı (Mütləq ən sonda olmalıdır!)
    // Bu marşrut yuxarıdakı heç bir URL uyğun gəlmədikdə işə düşəcək.
    Route::get('/{slug}', [FrontHomeController::class, 'categoryDetails'])->name('category-details');
});


