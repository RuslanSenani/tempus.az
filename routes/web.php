<?php

use App\Http\Controllers\Front\FrontHomeController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontHomeController::class, 'index'])->name('home');



//Route::get('lang/{lang}', function ($lang) {
//    // Dilləri yoxla ki, kənar (yad) dil daxil edilməsin
//    if (in_array($lang, config('app.locales'))) {
//        session(['locale' => $lang]); // Seçilən dili sessiyaya yazırıq
//    }
//    return redirect()->back(); // İstifadəçini qaldığı səhifəyə geri qaytarırıq
//})->name('lang.switch');
Route::get('lang/{lang}', [LanguageController::class, 'switch'])->name('lang.switch');
//Route::get('lang/{lang}', function ($locale) {
//    if (in_array($locale, config('app.locales'))) {
//        session(['locale' => $locale]);
//    }
//    return redirect()->back();
//});
