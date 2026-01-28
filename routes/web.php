<?php

use App\Http\Controllers\Front\FrontHomeController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontHomeController::class, 'index'])->name('home');
Route::get('lang/{lang}', [LanguageController::class, 'switch'])->name('lang.switch');

Route::get('/about-us', [FrontHomeController::class, 'about'])->name('about-us');


Route::get('/all-categories', [FrontHomeController::class, 'allCategories'])->name('all-categories');
Route::get('/category-details/{id}', [FrontHomeController::class, 'categoryDetails'])->name('category-details');

Route::get('/preparation', [FrontHomeController::class, 'preparation'])->name('preparation');
Route::get('/preparation-detail/{id}', [FrontHomeController::class, 'preparationDetail'])->name('preparation-detail');



