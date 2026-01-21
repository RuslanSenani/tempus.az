<?php

use App\Http\Controllers\Front\FrontHomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontHomeController::class, 'index'])->name('home');

Route::get('/{locale}', function ($locale) {
    if (in_array($locale, config('app.locales'))) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});
