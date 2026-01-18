<?php

use App\Http\Controllers\Front\FrontHomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontHomeController::class, 'index'])->name('home');
