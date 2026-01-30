<?php

use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\FrontHomeController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontHomeController::class, 'index'])->name('home');
Route::get('lang/{lang}', [LanguageController::class, 'switch'])->name('lang.switch');

Route::get('/about-us', [FrontHomeController::class, 'about'])->name('about-us');


Route::get('/all-categories', [FrontHomeController::class, 'allCategories'])->name('all-categories');
Route::get('/category-details/{id}', [FrontHomeController::class, 'categoryDetails'])->name('category-details');

Route::get('/preparation', [FrontHomeController::class, 'preparation'])->name('preparation');
Route::get('/preparation/page/{page}', [FrontHomeController::class, 'preparation'])->name('preparation.page');
Route::get('/preparation-detail/{id}', [FrontHomeController::class, 'preparationDetail'])->name('preparation-detail');

Route::get('/partners', [FrontHomeController::class, 'partners'])->name('partners');
Route::get('partners/page/{page}', [FrontHomeController::class, 'partners'])->name('partners.page');

Route::get('/medical-info', [FrontHomeController::class, 'medicalInfo'])->name('medical-info');
Route::get('/medical-info-details/{id}', [FrontHomeController::class, 'medicalInfoDetails'])->name('medical-info-details');

Route::get('/contact', [FrontHomeController::class, 'contact'])->name('contact');
Route::post('/contact-us', [FrontHomeController::class, 'contactUs'])->name('contact-us');

Route::get('/vacancy', [FrontHomeController::class, 'vacancy'])->name('vacancy');
//Route::post('/send-vacancy', [FrontHomeController::class, 'sendVacancy'])->name('send-vacancy');

Route::get('/media', [FrontHomeController::class, 'media'])->name('media');
Route::get('/media-details/{id}', [FrontHomeController::class, 'mediaDetails'])->name('media-details');
Route::get('/media/page/{page}', [FrontHomeController::class, 'media'])->name('media.page');


Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

